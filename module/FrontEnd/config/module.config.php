<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace OpenInvoices\FrontEnd;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\DashboardController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'customers' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/customers[/:action]',
                    'defaults' => [
                        'controller' => Controller\CustomersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'invoices' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/invoices[/:action]',
                    'defaults' => [
                        'controller' => Controller\InvoicesController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'taxes' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/taxes[/:action]',
                    'defaults' => [
                        'controller' => Controller\TaxesController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Customers',
                'route' => 'customers',
            ],
            [
                'label' => 'Invoices',
                'route' => 'invoices',
            ],
            [
                'label' => 'Taxes',
                'route' => 'taxes',
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\CustomersController::class => InvokableFactory::class,
            Controller\DashboardController::class => InvokableFactory::class,
            Controller\InvoicesController::class => InvokableFactory::class,
            Controller\TaxesController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
