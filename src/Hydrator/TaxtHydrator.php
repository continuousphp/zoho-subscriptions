<?php

namespace Zoho\Subscriptions\Hydrator;

use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zoho\Subscriptions\Hydrator\Strategy\CardStrategy;
use Zoho\Subscriptions\Hydrator\Strategy\CustomerStrategy;
use Zoho\Subscriptions\Hydrator\Strategy\DateTimeFormatterStrategy;
use Zoho\Subscriptions\Hydrator\Strategy\PlanStrategy;

class TaxHydrator extends ClassMethodsHydrator
{
}