<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions\Entity;

/**
 * Class Plan
 *
 * @package Zoho\Subscriptions\Entity
 */
class Plan implements EntityInterface
{
    use TimestampableTrait;
    use StatusTrait;

    /**
     * Unique string of your choice which lets you identify this plan.
     *
     * @var string
     */
    protected $planCode;

    /**
     * Name of your choice to be displayed in the interface and invoices.
     *
     * @var string
     */
    protected $name;

    /**
     * The customer is charged an amount over an interval for the subscription.
     *
     * @var string
     */
    protected $recurringPrice;

    /**
     * Indicates the number of intervals between each billing. If interval=2, the customer would be
     * billed every two months or years depending on the value for interval_unit.
     *
     * @var string
     */
    protected $interval;

    /**
     * The values can be either months or years. For interval=2 and interval_unit=months,
     * the customer is billed every two months.
     *
     * @var string
     */
    protected $intervalUnit;

    /**
     * Number of cycles this plan’s subscription should run for. If billing_cycles=12, the subscription
     * would expire after 12 cycles. If billing_cycles=-1, the subscription would run until it is cancelled.
     * If interval=2, interval_unit=months and billing_cycles=12, the customer would be billed every
     * 2 months and this would go on for 12 times.
     *
     * @var string
     */
    protected $billingCycles;

    /**
     * Number of free trial days that can be granted when a customer is subscribed to this plan.
     *
     * @var integer
     */
    protected $trialPeriod;

    /**
     * This indicates a one-time fee charged upfront while creating a subscription for this plan.
     *
     * @var float
     */
    protected $setupFee;

    /**
     * List of addons that the plan is associated with. It holds the list of objects with addon_code
     * and name as properties.
     *
     * @var array
     */
    protected $addons;

    /**
     * Product ID to which you want to associate this plan with.
     *
     * @var string
     */
    protected $productId;

    /**
     * Tax ID to which you would like to associate with this plan.
     *
     * @var string
     */
    protected $taxId;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * Get the plan code
     *
     * @return string
     */
    public function getPlanCode()
    {
        return $this->planCode;
    }

    /**
     * Set the plan code
     *
     * @param string $planCode
     * @return Plan
     */
    public function setPlanCode($planCode)
    {
        $this->planCode = $planCode;
        return $this;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param string $name
     * @return Plan
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the recurring price
     *
     * @return string
     */
    public function getRecurringPrice()
    {
        return $this->recurringPrice;
    }

    /**
     * Set the recurring price
     *
     * @param string $recurringPrice
     * @return Plan
     */
    public function setRecurringPrice($recurringPrice)
    {
        $this->recurringPrice = $recurringPrice;
        return $this;
    }

    /**
     * Get the interval
     *
     * @return string
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set the interval
     *
     * @param string $interval
     * @return Plan
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * Get the interval unit
     *
     * @return string
     */
    public function getIntervalUnit()
    {
        return $this->intervalUnit;
    }

    /**
     * Set the interval unit
     *
     * @param string $intervalUnit
     * @return Plan
     */
    public function setIntervalUnit($intervalUnit)
    {
        $this->intervalUnit = $intervalUnit;
        return $this;
    }

    /**
     * Get the billing cycles
     *
     * @return string
     */
    public function getBillingCycles()
    {
        return $this->billingCycles;
    }

    /**
     * Set the billing cycles
     *
     * @param string $billingCycles
     * @return Plan
     */
    public function setBillingCycles($billingCycles)
    {
        $this->billingCycles = $billingCycles;
        return $this;
    }

    /**
     * Get the trial period
     *
     * @return int
     */
    public function getTrialPeriod()
    {
        return $this->trialPeriod;
    }

    /**
     * Set the trial period
     *
     * @param int $trialPeriod
     * @return Plan
     */
    public function setTrialPeriod($trialPeriod)
    {
        $this->trialPeriod = $trialPeriod;
        return $this;
    }

    /**
     * Get the setup fee
     *
     * @return float
     */
    public function getSetupFee()
    {
        return $this->setupFee;
    }

    /**
     * Set the setup fee
     *
     * @param float $setupFee
     * @return Plan
     */
    public function setSetupFee($setupFee)
    {
        $this->setupFee = $setupFee;
        return $this;
    }

    /**
     * Get the addons
     *
     * @return array
     */
    public function getAddons()
    {
        return $this->addons;
    }

    /**
     * Set the addons
     *
     * @param array $addons
     * @return Plan
     */
    public function setAddons(array $addons)
    {
        $this->addons = $addons;
        return $this;
    }

    /**
     * Get the product ID
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the product ID
     *
     * @param string $productId
     * @return Plan
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * Get the tax ID
     *
     * @return string
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * Set the tax ID
     *
     * @param string $taxId
     * @return Plan
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
}
