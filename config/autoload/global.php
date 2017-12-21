<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => 'mysql:dbname=openinvoices;host=localhost;charset=utf8',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ],
    ],
    'service_manager' => [
        'factories' => [
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
    // Session configuration.
    'session_config' => [
        'cookie_lifetime'     => 60*60*1, // Session cookie will expire in 1 hour.
        'gc_maxlifetime'      => 60*60*24*30, // How long to store session data on server (for 1 month).
    ],
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            \Zend\Session\Validator\RemoteAddr::class,
            \Zend\Session\Validator\HttpUserAgent::class,
        ]
    ],
    // Session storage configuration.
    'session_storage' => [
        'type' => \Zend\Session\Storage\SessionArrayStorage::class
    ],
];
