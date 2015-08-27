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

        if (substr($payload, 0, 8) === 'payload=') {
            $payload = substr($payload, 8);
        }

        $data = Json::decode(urldecode($payload), Json::TYPE_ARRAY);

        //error_log(var_export($data, true));



        return new JsonModel();
    }
}