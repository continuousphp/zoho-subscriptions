<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

namespace Zoho\Subscriptions\Entity;

/**
 * Trait StatusTrait
 *
 * @package Zoho\Subscriptions\Entity
 */
trait StatusTrait
{
    /**
     * Status of the item.
     *
     * @var string
     */
    protected $status;

    /**
     * Get the status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the status
     *
     * @param string $status
     * @return StatusTrait
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Is item active
     *
     * @return bool
     */
    public function isActive()
    {
        return ($this->status == 'active');
    }
}
