<?php

namespace ZohoTest\Service\Webhook;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\EventManager\SharedEventManager;

class SubscriptionTest extends TestCase
{
    /** @var \Zoho\Subscriptions\Service\Webhook\Subscription */
    protected $instance;

    protected $subscriptionDataCreated = [
        'event_type' => 'subscription_created',
        'data' => array(
            'subscription' => [
                'subscription_id' => '135953000000117264',
                'product_id' => '135953000000042001',
                'interval' => 1,
                'payment_terms' => 0,
                'payment_terms_label' => 'Due on Receipt',
                'end_of_term' => false,
                'next_billing_at' => '2016-08-24',
                'product_name' => 'Continuous Delivery/Deployment',
                'current_term_starts_at' => '2015-08-24',
                'customer' =>
                    array(
                        'shipping_address' =>
                            array(
                                'zip' => '',
                                'fax' => '',
                                'street' => '',
                                'state' => '',
                                'city' => '',
                                'country' => '',
                            ),
                        'first_name' => '',
                        'display_name' => 'Webhook Test',
                        'payment_terms' => 0,
                        'email' => 'pascal.paulis+webhook-test@continuousphp.com',
                        'company_name' => 'continuousphp-test',
                        'website' => '',
                        'payment_terms_label' => 'Due on Receipt',
                        'zcrm_contact_id' => '',
                        'last_name' => '',
                        'customer_id' => '135953000000112118',
                        'zcrm_account_id' => '',
                        'billing_address' =>
                            array(
                                'zip' => '',
                                'fax' => '',
                                'street' => '',
                                'state' => '',
                                'city' => '',
                                'country' => '',
                            ),
                    ),
                'updated_time' => '2015-08-24T16:53:32+0200',
                'interval_unit' => 'years',
                'current_term_ends_at' => '2016-08-24',
                'amount' => 3553,
                'salesperson_name' => '',
                'name' => 'Continuous Delivery/Deployment-continuousphp Continuous Delivery/Deployment Solo Plan',
                'reference_id' => '',
                'salesperson_id' => '',
                'currency_symbol' => '€',
                'activated_at' => '2015-08-24',
                'currency_code' => 'EUR',
                'custom_fields' =>
                    array(),
                'child_invoice_id' => '135953000000117274',
                'status' => 'live',
                'sub_total' => 3553,
                'addons' =>
                    array(),
                'last_billing_at' => '2015-08-24',
                'contactpersons' =>
                    array(
                        0 =>
                            array(
                                'phone' => '',
                                'email' => 'pascal.paulis+webhook-test@continuousphp.com',
                                'zcrm_contact_id' => '',
                                'contactperson_id' => '135953000000112120',
                                'mobile' => '',
                            ),
                    ),
                'expires_at' => '',
                'plan' =>
                    array(
                        'setup_fee_tax_id' => '',
                        'total' => 3553,
                        'tax_name' => '',
                        'setup_fee' => 0,
                        'setup_fee_tax_type' => '',
                        'tax_type' => '',
                        'plan_code' => 'CD-solo-yearly',
                        'plan_id' => 135953000000056055,
                        'discount' => 0,
                        'price' => 209,
                        'description' => '',
                        'name' => 'continuousphp Continuous Delivery/Deployment Solo Plan',
                        'setup_fee_tax_name' => '',
                        'tax_id' => '',
                        'quantity' => 17,
                        'tax_percentage' => '',
                        'setup_fee_tax_percentage' => '',
                    ),
                'created_time' => '2015-08-24T16:53:32+0200',
                'auto_collect' => false,
                'taxes' => array()
            ]
        )
    ];

    protected $subscriptionDataUpgraded = array (
        'event_type' => 'subscription_upgraded',
        'data' =>
            array (
                'subscription' =>
                    array (
                        'subscription_id' => '135953000000262382',
                        'product_id' => '135953000000042001',
                        'interval' => 1,
                        'payment_terms' => 0,
                        'payment_terms_label' => 'Due On Receipt',
                        'end_of_term' => false,
                        'next_billing_at' => '2015-11-21',
                        'product_name' => 'continuousphp',
                        'current_term_starts_at' => '2015-11-03',
                        'customer' =>
                            array (
                                'shipping_address' =>
                                    array (
                                        'zip' => '1234',
                                        'fax' => '',
                                        'street' => 'test',
                                        'state' => 'test',
                                        'city' => 'test',
                                        'country' => 'Belgium',
                                    ),
                                'first_name' => '',
                                'display_name' => 'CPHP SUBSCRIPTION TEST',
                                'payment_terms' => 0,
                                'email' => 'pascal.paulis@continuousphp.com',
                                'company_name' => 'CPHP SUBSCRIPTION TEST',
                                'website' => '',
                                'payment_terms_label' => 'Due on Receipt',
                                'zcrm_contact_id' => '',
                                'last_name' => '',
                                'customer_id' => '135953000000168080',
                                'zcrm_account_id' => '',
                                'billing_address' =>
                                    array (
                                        'zip' => '1234',
                                        'fax' => '',
                                        'street' => 'test',
                                        'state' => 'test',
                                        'city' => 'test',
                                        'country' => 'Belgium',
                                    ),
                            ),
                        'updated_time' => '2015-11-03T14:50:56+0100',
                        'interval_unit' => 'months',
                        'current_term_ends_at' => '2015-11-21',
                        'amount' => 67.859999999999999,
                        'salesperson_name' => '',
                        'name' => 'continuousphp-Continuous Delivery/Deployment Team Member Plan',
                        'reference_id' => '',
                        'salesperson_id' => '',
                        'currency_symbol' => '€',
                        'activated_at' => '2015-11-21',
                        'currency_code' => 'EUR',
                        'previous_attribute' =>
                            array (
                                'status' => 'live',
                                'quantity' => 1,
                                'plan_code' => 'CD-team-monthly',
                                'plan_id' => '135953000000056061',
                                'plan_name' => 'Continuous Delivery/Deployment Team Member Plan',
                            ),
                        'custom_fields' =>
                            array (
                            ),
                        'child_invoice_id' => '135953000000262445',
                        'status' => 'live',
                        'sub_total' => 58,
                        'addons' =>
                            array (
                            ),
                        'last_billing_at' => '2015-11-03',
                        'contactpersons' =>
                            array (
                                0 =>
                                    array (
                                        'phone' => '',
                                        'email' => 'pascal.paulis@continuousphp.com',
                                        'zcrm_contact_id' => '',
                                        'contactperson_id' => '135953000000168082',
                                        'mobile' => '',
                                    ),
                            ),
                        'expires_at' => '',
                        'plan' =>
                            array (
                                'setup_fee_tax_id' => '',
                                'total' => 58,
                                'tax_name' => 'VAT-LU17',
                                'setup_fee' => 0,
                                'setup_fee_tax_type' => '',
                                'tax_type' => 'tax',
                                'plan_code' => 'CD-team-monthly',
                                'plan_id' => 135953000000056060,
                                'discount' => 0,
                                'price' => 29,
                                'description' => '',
                                'name' => 'Continuous Delivery/Deployment Team Member Plan',
                                'setup_fee_tax_name' => '',
                                'tax_id' => '135953000000040019',
                                'quantity' => 2,
                                'tax_percentage' => 17,
                                'setup_fee_tax_percentage' => '',
                            ),
                        'created_time' => '2015-11-03T14:50:43+0100',
                        'auto_collect' => false,
                        'taxes' =>
                            array (
                                0 =>
                                    array (
                                        'tax_name' => 'VAT-LU17 (17%)',
                                        'tax_amount' => 9.8599999999999994,
                                        'tax_id' => '135953000000040019',
                                    ),
                            ),
                    ),
            ),
        'event_time' => '2015-11-03',
        'event_id' => 135953000000262460,
        'event_time_formatted' => '03/11/2015',
    );

    protected $subscriptionDataDowngraded = array (
        'event_type' => 'subscription_downgraded',
        'data' =>
            array (
                'subscription' =>
                    array (
                        'subscription_id' => '135953000000262382',
                        'product_id' => '135953000000042001',
                        'interval' => 1,
                        'payment_terms' => 0,
                        'payment_terms_label' => 'Due On Receipt',
                        'end_of_term' => false,
                        'next_billing_at' => '2015-11-21',
                        'product_name' => 'continuousphp',
                        'current_term_starts_at' => '2015-11-03',
                        'customer' =>
                            array (
                                'shipping_address' =>
                                    array (
                                        'zip' => '1234',
                                        'fax' => '',
                                        'street' => 'test',
                                        'state' => 'test',
                                        'city' => 'test',
                                        'country' => 'Belgium',
                                    ),
                                'first_name' => '',
                                'display_name' => 'CPHP SUBSCRIPTION TEST',
                                'payment_terms' => 0,
                                'email' => 'pascal.paulis@continuousphp.com',
                                'company_name' => 'CPHP SUBSCRIPTION TEST',
                                'website' => '',
                                'payment_terms_label' => 'Due on Receipt',
                                'zcrm_contact_id' => '',
                                'last_name' => '',
                                'customer_id' => '135953000000168080',
                                'zcrm_account_id' => '',
                                'billing_address' =>
                                    array (
                                        'zip' => '1234',
                                        'fax' => '',
                                        'street' => 'test',
                                        'state' => 'test',
                                        'city' => 'test',
                                        'country' => 'Belgium',
                                    ),
                            ),
                        'updated_time' => '2015-11-03T14:50:56+0100',
                        'interval_unit' => 'months',
                        'current_term_ends_at' => '2015-11-21',
                        'amount' => 67.859999999999999,
                        'salesperson_name' => '',
                        'name' => 'continuousphp-Continuous Delivery/Deployment Team Member Plan',
                        'reference_id' => '',
                        'salesperson_id' => '',
                        'currency_symbol' => '€',
                        'activated_at' => '2015-11-21',
                        'currency_code' => 'EUR',
                        'previous_attribute' =>
                            array (
                                'status' => 'live',
                                'quantity' => 1,
                                'plan_code' => 'CD-team-monthly',
                                'plan_id' => '135953000000056061',
                                'plan_name' => 'Continuous Delivery/Deployment Team Member Plan',
                            ),
                        'custom_fields' =>
                            array (
                            ),
                        'child_invoice_id' => '135953000000262445',
                        'status' => 'live',
                        'sub_total' => 58,
                        'addons' =>
                            array (
                            ),
                        'last_billing_at' => '2015-11-03',
                        'contactpersons' =>
                            array (
                                0 =>
                                    array (
                                        'phone' => '',
                                        'email' => 'pascal.paulis@continuousphp.com',
                                        'zcrm_contact_id' => '',
                                        'contactperson_id' => '135953000000168082',
                                        'mobile' => '',
                                    ),
                            ),
                        'expires_at' => '',
                        'plan' =>
                            array (
                                'setup_fee_tax_id' => '',
                                'total' => 58,
                                'tax_name' => 'VAT-LU17',
                                'setup_fee' => 0,
                                'setup_fee_tax_type' => '',
                                'tax_type' => 'tax',
                                'plan_code' => 'CD-team-monthly',
                                'plan_id' => 135953000000056060,
                                'discount' => 0,
                                'price' => 29,
                                'description' => '',
                                'name' => 'Continuous Delivery/Deployment Team Member Plan',
                                'setup_fee_tax_name' => '',
                                'tax_id' => '135953000000040019',
                                'quantity' => 2,
                                'tax_percentage' => 17,
                                'setup_fee_tax_percentage' => '',
                            ),
                        'created_time' => '2015-11-03T14:50:43+0100',
                        'auto_collect' => false,
                        'taxes' =>
                            array (
                                0 =>
                                    array (
                                        'tax_name' => 'VAT-LU17 (17%)',
                                        'tax_amount' => 9.8599999999999994,
                                        'tax_id' => '135953000000040019',
                                    ),
                            ),
                    ),
            ),
        'event_time' => '2015-11-03',
        'event_id' => 135953000000262460,
        'event_time_formatted' => '03/11/2015',
    );

    public function setUp()
    {
        $this->instance = new \Zoho\Subscriptions\Service\Webhook\Subscription();
        $sharedEventManager = new SharedEventManager();
        $this->instance->getEventManager()->setSharedManager($sharedEventManager);
    }

    public function testTriggerSubscriptionEvent_NoEventType()
    {
        unset($this->subscriptionDataCreated['event_type']);

        $response = $this->instance->triggerSubscriptionEvent($this->subscriptionDataCreated);

        $this->assertInstanceOf('\Zend\Http\PhpEnvironment\Response', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testTriggerSubscriptionEvent_InvalidEventType()
    {
        $this->subscriptionDataCreated['event_type'] = 'invalid_event';

        $response = $this->instance->triggerSubscriptionEvent($this->subscriptionDataCreated);

        $this->assertInstanceOf('\Zend\Http\PhpEnvironment\Response', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testTriggerSubscriptionEvent_SubscriptionCreated()
    {
        $eventTriggered = false;
        $subscriptionData = $this->subscriptionDataCreated;

        $this->instance->getEventManager()->getSharedManager()->attach(
            'subscriptionWebhook', 'subscriptionCreated', function (\Zend\EventManager\Event $e) use (&$eventTriggered, $subscriptionData)
        {
            $eventTriggered = true;
            $this->assertEquals($e->getParam('subscription'), $subscriptionData['data']['subscription']);
        });

        $this->instance->triggerSubscriptionEvent($this->subscriptionDataCreated);

        $this->assertTrue($eventTriggered);
    }

    public function testTriggerSubscriptionEvent_SubscriptionUpgraded()
    {
        $eventTriggered = false;
        $subscriptionData = $this->subscriptionDataUpgraded;

        $this->instance->getEventManager()->getSharedManager()->attach(
            'subscriptionWebhook', 'subscriptionUpdated', function (\Zend\EventManager\Event $e) use (&$eventTriggered, $subscriptionData)
        {
            $eventTriggered = true;
            $this->assertEquals($e->getParam('subscription'), $subscriptionData['data']['subscription']);
        });

        $this->instance->triggerSubscriptionEvent($this->subscriptionDataUpgraded);

        $this->assertTrue($eventTriggered);
    }

    public function testTriggerSubscriptionEvent_SubscriptionDowngraded()
    {
        $eventTriggered = false;
        $subscriptionData = $this->subscriptionDataDowngraded;

        $this->instance->getEventManager()->getSharedManager()->attach(
            'subscriptionWebhook', 'subscriptionUpdated', function (\Zend\EventManager\Event $e) use (&$eventTriggered, $subscriptionData)
        {
            $eventTriggered = true;
            $this->assertEquals($e->getParam('subscription'), $subscriptionData['data']['subscription']);
        });

        $this->instance->triggerSubscriptionEvent($this->subscriptionDataDowngraded);

        $this->assertTrue($eventTriggered);
    }
}
