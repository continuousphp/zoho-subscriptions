<?php
/**
 * SubscriptionController.php
 *
 * @date        25.08.2015
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SubscriptionController.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Zoho\Subscriptions\Controller\Webhook;

use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Json\Json;
use Zend\View\Model\JsonModel;

/**
 * SubscriptionController
 *
 * @package     Zoho
 * @subpackage  Subscriptions
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SubscriptionController extends AbstractActionController
{
    public function callbackAction()
    {
        $payload = file_get_contents("php://input");

        $zohoConfig = $this->getServiceLocator()->get('config')['zoho'];

        $accessToken = $this->params()->fromQuery('token');

        if (!array_key_exists('webhook_access_token', $zohoConfig) ||
            $accessToken !== $zohoConfig['webhook_access_token'])
        {
            $response = new Response();
            $response->setStatusCode(403)
                     ->setReasonPhrase('Invalid access token.')
                     ->setContent('Invalid access token.');
            return $response;
        }

        if (substr($payload, 0, 8) === 'payload=') {
            $payload = substr($payload, 8);
        }

        $data = Json::decode(urldecode($payload), Json::TYPE_ARRAY);

        /** @var \Zoho\Subscriptions\Service\Webhook\Subscription $serviceWebhook */
        $serviceWebhook = $this->getServiceLocator()->get('Zoho\Subscriptions\Service\Webhook\Subscription');

        try {
            $response = $serviceWebhook->triggerSubscriptionEvent($data);
        } catch (\Exception $e) {
            $response = new Response();
            $response->setStatusCode(500)
                     ->setReasonPhrase('Unexpected server error.')
                     ->setContent('Unexpected server error.');
        }

        return $response;
    }
}