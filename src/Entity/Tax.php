<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions\Entity;

/**
 * Class Tax
 *
 * @package Zoho\Subscriptions\Entity
 */
class Tax implements EntityInterface
{
    /** @var integer */
    protected $taxId;

    /** @var string */
    protected $taxName;

    /** @var integer */
    protected $taxPercentage;

    /**
     * @return int
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * @param int $taxId
     * @return $this
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxName()
    {
        return $this->taxName;
    }

    /**
     * @param string $taxName
     * @return $this
     */
    public function setTaxName($taxName)
    {
        $this->taxName = $taxName;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaxPercentage()
    {
        return $this->taxPercentage;
    }

    /**
     * @param int $taxPercentage
     * @return $this;
     */
    public function setTaxPercentage($taxPercentage)
    {
        $this->taxPercentage = $taxPercentage;
        return $this;
    }
}
