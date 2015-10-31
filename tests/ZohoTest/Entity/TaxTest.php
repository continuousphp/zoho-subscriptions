<?php
/**
 * TaxTest.php
 *
 * @date        30.10.2015
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        TaxTest.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ZohoTest\Entity;

/**
 * TaxTest
 *
 * @package     ZohoTest
 * @subpackage  Entity
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class TaxTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Zoho\Subscriptions\Entity\Tax */
    protected $instance;

    public function setUp()
    {
        $this->instance = new \Zoho\Subscriptions\Entity\Tax();
    }

    /**
     * Test the setter and getter for the tax ID.
     */
    public function testSetGetTaxId()
    {
        // Test fluent interface
        $this->assertSame($this->instance, $this->instance->setTaxId(16515616165165));

        // Test setter and getter
        $this->assertEquals(16515616165165, $this->instance->getTaxId());
    }

    /**
     * Test the setter and getter for the tax name.
     */
    public function testSetGetTaxName()
    {
        // Test fluent interface
        $this->assertSame($this->instance, $this->instance->setTaxName('VAT-BE21'));

        // Test setter and getter
        $this->assertEquals('VAT-BE21', $this->instance->getTaxName());
    }

    /**
     * Test the setter and getter for the tax percentage.
     */
    public function testSetGetTaxPercentage()
    {
        // Test fluent interface
        $this->assertSame($this->instance, $this->instance->setTaxPercentage(21));

        // Test setter and getter
        $this->assertEquals(21, $this->instance->getTaxPercentage());
    }
}