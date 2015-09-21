<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use Zoho\Subscriptions\Entity\Plan as PlanEntity;

/**
 * Class PlanStrategy
 *
 * @package Zoho\Subscriptions\Hydrator\Strategy
 */
class PlanStrategy implements StrategyInterface
{
    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be extracted.
     */
    public function extract($value)
    {
        if (!$value instanceof PlanEntity) {
            throw new \InvalidArgumentException('The given value must be a Plan instance.');
        }

        $hydrator = new ClassMethods(true);

        return $hydrator->extract($value);
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @return mixed Returns the value that should be hydrated.
     */
    public function hydrate($value)
    {
        if (!is_array($value)) {
            return $value;
        }
        $hydrator = new ClassMethods(true);
        return $hydrator->hydrate($value, new PlanEntity());
    }
}
