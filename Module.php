<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\HydratorProviderInterface;

/**
 * Class Module
 *
 * @package Zoho\Subscriptions
 */
class Module implements AutoloaderProviderInterface, ConfigProviderInterface, HydratorProviderInterface
{
    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/',
                ],
            ],
        ];
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getHydratorConfig()
    {
        return [
            'invokables' => [
                'Zoho\Subscriptions\Hydrator\Customer' => 'Zoho\Subscriptions\Hydrator\CustomerHydrator',
                'Zoho\Subscriptions\Hydrator\Subscription' => 'Zoho\Subscriptions\Hydrator\SubscriptionHydrator',
            ]
        ];
    }


}