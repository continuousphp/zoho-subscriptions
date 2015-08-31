<?php

namespace Zoho\Subscriptions\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zoho\Subscriptions\Hydrator\Strategy\CardStrategy;
use Zoho\Subscriptions\Hydrator\Strategy\CustomerStrategy;
use Zoho\Subscriptions\Hydrator\Strategy\DateTimeFormatterStrategy;
use Zoho\Subscriptions\Hydrator\Strategy\PlanStrategy;

class SubscriptionHydrator extends ClassMethodsHydrator
{
    public function __construct()
    {
        parent::__construct();

        $datetimeStrategy = new DateTimeFormatterStrategy(\DateTime::ISO8601);
        $planStrategy = new PlanStrategy();
        $cardStrategy = new CardStrategy();
        $customerStrategy = new CustomerStrategy();
        $this->addStrategy('created_time', $datetimeStrategy);
        $this->addStrategy('updated_time', $datetimeStrategy);
        $this->addStrategy('plan', $planStrategy);
        $this->addStrategy('card', $cardStrategy);
        $this->addStrategy('customer', $customerStrategy);
        $this->addStrategy('current_term_starts_at', $datetimeStrategy);
        $this->addStrategy('current_term_ends_at', $datetimeStrategy);
        $this->addStrategy('activated_at', $datetimeStrategy);
        $this->addStrategy('expires_at', $datetimeStrategy);
    }
}