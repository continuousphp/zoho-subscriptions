<?php
/**
 * Subscription.php
 *
 * @date        25.08.2015
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Subscription.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Zoho\Subscriptions\Service\Webhook;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Http\PhpEnvironment\Response;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Subscription
 *
 * @package     Zoho
 * @subpackage  Subscriptions
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Subscription implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{
    use ServiceLocatorAwareTrait;
    use EventManagerAwareTrait;

    public function __construct()
    {
        $this->getEventManager()->addIdentifiers([
            'subscriptionWebhook',
        ]);
    }

    public function triggerSubscriptionEvent(array $payload)
    {
        $response = new Response();

        if (!array_key_exists('event_type', $payload)) {
            $response->setStatusCode(400)
                     ->setContent('Invalid payload.');
            return $response;
        }

        switch ($payload['event_type']) {
            case 'subscription_created':
                $this->getEventManager()->trigger('subscriptionCreated', $this, ['subscription' => $payload['data']['subscription']]);
                break;
            case 'subscription_renewed':
                $this->getEventManager()->trigger('subscriptionRenewed', $this, ['subscription' => $payload['data']['subscription']]);
                break;
            case 'subscription_activation':
                $this->getEventManager()->trigger('subscriptionActivated', $this, ['subscription' => $payload['data']['subscription']]);
                break;
            case 'subscription_expired':
            case 'subscription_cancelled':
                break;
            case 'subscription_upgraded':
            case 'subscription_downgraded':
                $this->getEventManager()->trigger('subscriptionUpdated', $this, ['subscription' => $payload['data']['subscription']]);
                break;
            default:
                $response->setStatusCode(400)
                         ->setContent('Invalid event type: ' . $payload['event_type']);
                return $response;
        }

        $response->setStatusCode(200)
                 ->setContent('Success.');

        return $response;
    }
}
