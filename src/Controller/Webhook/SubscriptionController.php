<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions\Controller\Webhook;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Json\Json;

class SubscriptionController extends AbstractActionController
{
    public function callbackAction()
    {
        $data = Json::decode(file_get_contents("php://input"), Json::TYPE_ARRAY);

        error_log(var_export($data, true));
    }
}