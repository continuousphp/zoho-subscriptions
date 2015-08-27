<?php

namespace ZohoTest\Service\Webhook;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\EventManager\SharedEventManager;

class SubscriptionTest extends TestCase
{
    /** @var \Zoho\Subscriptions\Service\Webhook\Subscription */
    protected $instance;

    protected $subscriptionData = [
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

    public function setUp()
    {
        $this->instance = new \Zoho\Subscriptions\Service\Webhook\Subscription();
        $sharedEventManager = new SharedEventManager();
        $this->instance->getEventManager()->setSharedManager($sharedEventManager);
    }

    public function testTriggerSubscriptionEvent_NoEventType()
    {
        unset($this->subscriptionData['event_type']);

        $response = $this->instance->triggerSubscriptionEvent($this->subscriptionData);

        $this->assertInstanceOf('\Zend\Http\PhpEnvironment\Response', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testTriggerSubscriptionEvent_SubscriptionCreated()
    {
        $eventTriggered = false;
        $subscriptionData = $this->subscriptionData;

        $this->instance->getEventManager()->getSharedManager()->attach(
            'subscriptionWebhook', 'subscriptionCreated', function (\Zend\EventManager\Event $e) use (&$eventTriggered, $subscriptionData)
        {
            $eventTriggered = true;
            $this->assertEquals($e->getParam('subscription'), $subscriptionData['data']['subscription']);
        });

        $this->instance->triggerSubscriptionEvent($this->subscriptionData);

        $this->assertTrue($eventTriggered);
    }
}
