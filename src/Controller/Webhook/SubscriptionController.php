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

        $accessToken = $this->params()->fromQuery('access_token');

        if ($accessToken !== $this->getServiceLocator()->get('config')['zoho']['webhook_access_token']) {
            $response = new Response();
            $response->setStatusCode(403)
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
                     ->setContent('Unexpected server error.');
        }

        return $response;
    }
}