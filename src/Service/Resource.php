<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions\Service;

use Traversable;
use DomainException;
use Zend\Http;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zoho\Subscriptions\Entity\EntityInterface;

/**
 * Class Resource
 *
 * @package Zoho\Subscriptions\Service
 */
class Resource implements InputFilterAwareInterface, ServiceLocatorAwareInterface
{
    use InputFilterAwareTrait;
    use ServiceLocatorAwareTrait;

    const ZOHO_API_ENDPOINT = 'https://subscriptions.zoho.com/api/v1';

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var mixed
     */
    protected $curl;

    /**
     * @var array
     */
    protected $responseInfo;

    /**
     * @var string
     */
    protected $authToken;

    /**
     * @var string
     */
    protected $organizationId;

    /**
     * @var string
     */
    protected $collectionName;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * Get the collectionName
     *
     * @return string
     */
    public function getCollectionName()
    {
        return $this->collectionName;
    }

    /**
     * Set the collectionName
     *
     * @param string $collectionName
     * @return Resource
     */
    public function setCollectionName($collectionName)
    {
        $this->collectionName = $collectionName;
        return $this;
    }

    /**
     * Get the entityName
     *
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * Set the entityName
     *
     * @param string $entityName
     * @return Resource
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Resource
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param string $entityClass
     * @return Resource
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }

    /**
     * @return HydratorInterface
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param HydratorInterface $hydrator
     * @return Resource
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * Constructor
     *
     * @param $curl
     */
    public function __construct($authToken, $organizationId)
    {
        $this->authToken      = $authToken;
        $this->organizationId = $organizationId;
    }

    protected function request($url, $method = 'GET', $body = null)
    {
        $this->curl = curl_init();

        $zohoConfig = $this->getServiceLocator()->get('config')['zoho'];

        if (array_key_exists('connection_timeout_milliseconds', $zohoConfig) &&
            !empty($zohoConfig['connection_timeout_milliseconds']))
        {
            curl_setopt(
                $this->curl, CURLOPT_CONNECTTIMEOUT_MS,
                $this->getServiceLocator()->get('config')['zoho']['connection_timeout_milliseconds']
            );
        }

        if (array_key_exists('timeout_milliseconds', $zohoConfig) &&
            !empty($zohoConfig['timeout_milliseconds']))
        {
            curl_setopt(
                $this->curl, CURLOPT_TIMEOUT_MS,
                $this->getServiceLocator()->get('config')['zoho']['timeout_milliseconds']
            );
        }

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Authorization: Zoho-authtoken ' . $this->getAuthToken(),
            'X-com-zoho-subscriptions-organizationid: ' . $this->getOrganizationId(),
        ]);

        curl_setopt($this->curl, CURLOPT_URL, $url);

        switch ($method) {
            case 'POST':
                curl_setopt($this->curl, CURLOPT_POST, true);
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);
                break;
            case 'PUT':
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($this->curl, CURLOPT_POSTFIELDS, $body);
                break;
            case 'DELETE':
                curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }

        $result             = curl_exec($this->curl);
        $this->responseInfo = curl_getinfo($this->curl);

        if (!$result) {
            throw new Exception(Exception::TYPE_GATEWAY_TIMEOUT, 'Timeout', 'Zoho Subscriptions is currently unreachable.');
        }

        $result = json_decode($result, true);

        if ($this->getLastResponseHttpCode() == 429) {
            throw new Exception(Exception::TYPE_TOO_MANY_REQUESTS, 'Too many Requests', 'Zoho Subscriptions is currently not available because of too many requests.');
        } else if ($this->getLastResponseHttpCode() == 404 ||
            ($this->getLastResponseHttpCode() == 400 && array_key_exists('code', $result) &&
                $result['code'] == 3004))
        {
            throw new Exception(Exception::TYPE_RESOURCE_NOT_FOUND, 'Not found', 'Resource not found.');
        } else if ($this->getLastResponseHttpCode() == 522) {
            throw new Exception(Exception::TYPE_GATEWAY_TIMEOUT, 'Zoho Timeout', 'Zoho Subscriptions is currently not available.');
        }

        curl_close($this->curl);

        return $result;
    }

    protected function getLastResponseHttpCode()
    {
        return $this->responseInfo['http_code'];
    }

    /**
     * @param array $options The options to add to the query
     * @return array
     */
    public function fetchAll($options = [])
    {
        $url = self::ZOHO_API_ENDPOINT . $this->getPath();

        if (!empty($options)) {
            $url .= '?' . http_build_query($options);
        }

        $result = $this->request($url);

        if ($this->getLastResponseHttpCode() != 200) {
            throw new DomainException('Not found.');
        }

        $collectionName = $this->getCollectionName();
        $collection     = $result[$collectionName];
        $entityClass    = $this->getEntityClass();
        $resultList     = [];

        foreach ($collection as $member) {
            $resultList[] = $this->getHydrator()->hydrate($member, new $entityClass());
        }

        return $resultList;
    }

    /**
     * @param $id
     * @return EntityInterface
     */
    public function fetch($id)
    {
        $result = $this->request(self::ZOHO_API_ENDPOINT . $this->getPath() . '/' . $id);

        if ($this->getLastResponseHttpCode() != 200) {
            throw new DomainException('Not found.');
        }

        $entityClass = $this->getEntityClass();
        $entityName = $this->getEntityName();
        $entity = new $entityClass;
        $data = $result[$entityName];
        $entity = $this->getHydrator()->hydrate($data, $entity);

        return $entity;
    }

    /**
     * @param mixed $data
     * @return EntityInterface
     */
    public function create($data)
    {
        if ($data instanceof EntityInterface) {
            $data = $this->getHydrator()->extract($data);
        } elseif ($data instanceof Traversable) {
            $data = ArrayUtils::iteratorToArray($data);
        }

        $data = $this->removeIdleFields($data);

        $json = json_encode($data);

        if (false === $json) {
            throw new DomainException("Unprocessable entity", 422);
        }

        $result = $this->request(self::ZOHO_API_ENDPOINT . $this->getPath(), 'POST', $json);

        if ($this->getLastResponseHttpCode() == 201) {
            $entityClass = $this->getEntityClass();
            $entityName  = $this->getEntityName();
            $entity = new $entityClass;
            $data = $result[$entityName];
            $entity = $this->getHydrator()->hydrate($data, $entity);
            return $entity;
        }

        throw new DomainException($result && is_object($result) ? $result->message : "Couldn't create the resource.", $this->getLastResponseHttpCode());
    }

    /**
     * @param $id
     * @param mixed $data
     * @return EntityInterface
     */
    public function update($id, $data)
    {
        if ($data instanceof EntityInterface) {
            $data = $this->getHydrator()->extract($data);
        } elseif ($data instanceof Traversable) {
            $data = ArrayUtils::iteratorToArray($data);
        }

        $data = $this->removeIdleFields($data);

        $json = json_encode($data);

        if (false === $json) {
            throw new DomainException("Unprocessable entity", 422);
        }

        $result = $this->request(self::ZOHO_API_ENDPOINT . $this->getPath() . '/' . $id, 'PUT', $json);

        if ($this->getLastResponseHttpCode() == 200) {
            $entityClass = $this->getEntityClass();
            $entityName  = $this->getEntityName();
            $entity = new $entityClass;
            $data = $result[$entityName];
            $entity = $this->getHydrator()->hydrate($data, $entity);
            return $entity;
        }

        throw new DomainException($result && is_object($result) ? $result->message : "Couldn't update the resource.", $this->getLastResponseHttpCode());
    }

    protected function removeIdleFields(array $data)
    {
        foreach (array_keys($data) as $key) {
            if (is_null($data[$key])) {
                unset($data[$key]);
            } else if (is_array($data[$key])) {
                $data[$key] = $this->removeIdleFields($data[$key]);
            }
        }

        return $data;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $this->request(self::ZOHO_API_ENDPOINT . $this->getPath() . '/' . $id, 'DELETE');
        return true;
    }
}
