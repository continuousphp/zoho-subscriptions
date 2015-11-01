<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2015 Julien Guittard (http://julienguittard.com)
 */

return [
    'controllers' =>
        [
            'invokables' =>
                [
                    'Zoho\Subscriptions\Controller\Webhook\Subscription' => 'Zoho\Subscriptions\Controller\Webhook\SubscriptionController'
                ]
        ],
    'service_manager' => [
        'invokables' => [
            'Zoho\Subscriptions\Hydrator\Strategy\AddressStrategy' => 'Zoho\Subscriptions\Hydrator\Strategy\AddressStrategy',
            'Zoho\Subscriptions\Service\Webhook\Subscription' => 'Zoho\Subscriptions\Service\Webhook\Subscription'
        ],
        'abstract_factories' => [
            'Zoho\Subscriptions\Factory\ResourceAbstractFactory'
        ],
    ],
    'zoho' => [
        'ssl_config' => [
            'sslcapath' => '/etc/ssl/certs'
        ],
        'resources' => [
            'Zoho\Subscriptions\Resource\Tax' => [
                'path' => '/settings/taxes',
                'collectionName' => 'taxes',
                'entityName' => 'tax',
                'input-filter' => [],
            ],
            'Zoho\Subscriptions\Resource\Product' => [
                'path' => '/products',
                'collectionName' => 'products',
                'entityName' => 'product',
                'input-filter' => [
                    0 => [
                        'name' => 'name',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    1 => [
                        'name' => 'description',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    2 => [
                        'name' => 'emailIds',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    3 => [
                        'name' => 'redirectUrl',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\Uri',
                                'options' => [],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    4 => [
                        'name' => 'status',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\InArray',
                                'options' => [
                                    'haystack' => [
                                        0 => 'active',
                                        1 => 'inactive',
                                    ],
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                ]
            ],
            'Zoho\Subscriptions\Resource\Plan' => [
                'path' => '/plans',
                'collectionName' => 'plans',
                'entityName' => 'plan',
                'input-filter' => [],
            ],
            'Zoho\Subscriptions\Resource\Addon' => [
                'path' => '/addons',
                'collectionName' => 'addons',
                'entityName' => 'addon',
                'input-filter' => [
                    0 => [
                        'name' => '',
                        'required' => true,
                        'validators' => [

                        ],
                        'filters' => [

                        ],
                    ],
                ]
            ],
            'Zoho\Subscriptions\Resource\Coupon' => [
                'path' => '/coupons',
                'collectionName' => 'coupons',
                'entityName' => 'coupon',
                'input-filter' => [],
            ],
            'Zoho\Subscriptions\Resource\Customer' => [
                'path' => '/customers',
                'collectionName' => 'customers',
                'entityName' => 'customer',
                'input-filter' => [
                    0 => [
                        'name' => 'displayName',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    2 => [
                        'name' => 'firstName',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    3 => [
                        'name' => 'lastName',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    4 => [
                        'name' => 'email',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ],
                            1 => [
                                'name' => 'Zend\Validator\EmailAddress',
                                'options' => [],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    5 => [
                        'name' => 'companyName',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    6 => [
                        'name' => 'phone',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    7 => [
                        'name' => 'mobile',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    8 => [
                        'name' => 'website',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\Uri',
                                'options' => [
                                    'allowRelative' => false,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    9 => [
                        'name' => 'currencyCode',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    12 => [
                        'name' => 'pricePrecision',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\I18n\Validator\IsInt',
                                'options' => [
                                    'locale' => 'en_US',
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    16 => [
                        'name' => 'notes',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    17 => [
                        'name' => 'status',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\InArray',
                                'options' => [
                                    'haystack' => [
                                        0 => 'active',
                                        1 => 'inactive',
                                    ],
                                ],
                            ],
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                ],

                'strategies' => [
                    'billing_address' => 'Zoho\Subscriptions\Hydrator\Strategy\AddressStrategy',
                    'shipping_address' => 'Zoho\Subscriptions\Hydrator\Strategy\AddressStrategy',
                ]
            ],
            'Zoho\Subscriptions\Resource\ContactPerson' => [
                'path' => '/customers/:customer_id/contactpersons',
                'collectionName' => 'contactpersons',
                'entityName' => 'contactperson',
                'input-filter' => [
                    0 => [
                        'name' => 'contactpersonId',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\Digits',
                                'options' => [],
                            ],
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                            2 => [
                                'name' => 'Zend\Filter\Digits',
                                'options' => [],
                            ],
                        ],
                    ],
                    1 => [
                        'name' => 'firstName',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    2 => [
                        'name' => 'lastName',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    3 => [
                        'name' => 'email',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ],
                            1 => [
                                'name' => 'Zend\Validator\EmailAddress',
                                'options' => [],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    4 => [
                        'name' => 'phone',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    7 => [
                        'name' => 'mobile',
                        'required' => false,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                    'max' => 255,
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    0 => [
                        'name' => 'customerId',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\Digits',
                                'options' => [],
                            ],
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                            2 => [
                                'name' => 'Zend\Filter\Digits',
                                'options' => [],
                            ],
                        ],
                    ],
                ]
            ],
            'Zoho\Subscriptions\Resource\Subscription' => [
                'path' => '/subscriptions',
                'collectionName' => 'subscriptions',
                'entityName' => 'subscription',
                'input-filter' => [
                    0 => [
                        'name' => 'name',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\StringLength',
                                'options' => [
                                    'min' => 1,
                                ],
                            ],
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    1 => [
                        'name' => 'customer',
                        'required' => true,
                        'validators' => [

                        ],
                        'filters' => [

                        ],
                    ],
                    2 => [
                        'name' => 'amount',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\I18n\Validator\IsFloat',
                                'options' => [
                                    'locale' => 'en_US',
                                ],
                            ]
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                        ],
                    ],
                    3 => [
                        'name' => 'productId',
                        'required' => true,
                        'validators' => [
                            0 => [
                                'name' => 'Zend\Validator\Digits',
                                'options' => [],
                            ],
                        ],
                        'filters' => [
                            0 => [
                                'name' => 'Zend\Filter\StringTrim',
                            ],
                            1 => [
                                'name' => 'Zend\Filter\StripTags',
                            ],
                            2 => [
                                'name' => 'Zend\Filter\Digits',
                                'options' => [],
                            ],
                        ],
                    ],
                ]
            ],
            'Zoho\Subscriptions\Resource\Invoice' => [
                'path' => '/invoices',
                'collectionName' => 'invoices',
                'entityName' => 'invoice',
                'input-filter' => [],
            ],
            'Zoho\Subscriptions\Resource\Payment' => [
                'path' => '/payments',
                'collectionName' => 'payments',
                'entityName' => 'payment',
                'input-filter' => [],
            ],
            'Zoho\Subscriptions\Resource\HostedPage' => [
                'path' => '/hostedpages',
                'collectionName' => 'hostedpages',
                'entityName' => 'hostedpage',
                'input-filter' => [],
            ],

        ]
    ],
    'router' =>
        [
            'routes' =>
                [
                    'zoho-subscription' =>
                        [
                            'type' => 'literal',
                            'options' =>
                                [
                                    'route' => '/zoho-subscriptions'
                                ],
                            'child_routes' =>
                                [
                                    'webhook' =>
                                        [
                                            'type' => 'literal',
                                            'options' =>
                                                [
                                                    'route' => '/webhooks'
                                                ],
                                            'child_routes' =>
                                                [
                                                    'subscription' =>
                                                        [
                                                            'type' => 'literal',
                                                            'options' =>
                                                                [
                                                                    'route' => '/subscriptions',
                                                                    'defaults' =>
                                                                        [
                                                                            'controller' => 'Zoho\Subscriptions\Controller\Webhook\Subscription',
                                                                            'action' => 'callback'
                                                                        ]
                                                                ]
                                                        ],
                                                    'payment' =>
                                                        [
                                                            'type' => 'literal',
                                                            'options' =>
                                                                [
                                                                    'route' => '/payments',
                                                                    'defaults' =>
                                                                        [
                                                                            '__NAMESPACE__' => 'Zoho\Webhook',
                                                                            'controller' => 'payment',
                                                                            'action' => 'callback'
                                                                        ]
                                                                ]
                                                        ],
                                                    'invoice' =>
                                                        [
                                                            'type' => 'literal',
                                                            'options' =>
                                                                [
                                                                    'route' => '/invoices',
                                                                    'defaults' =>
                                                                        [
                                                                            '__NAMESPACE__' => 'Zoho\Webhook',
                                                                            'controller' => 'invoice',
                                                                            'action' => 'callback'
                                                                        ]
                                                                ]
                                                        ],
                                                ]
                                        ]
                                ]
                        ]
                ]
        ]
];