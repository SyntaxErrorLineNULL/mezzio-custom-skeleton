<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

return [
    'doctrine' => [
        'cache_dir' => 'data/doctrine/cache',
        'proxy_dir' => 'data/doctrine',
        'proxy_namespace' => 'SELN\\App\\Doctrine\\Proxy\\',
        'simpleAnnotationReader' => false,

        // you should add any other path containing annotated entity classes
        # TODO: fix metadata
        'metadata_dirs' => 'src/Application/Domain',
        'dev_mode' => false,
        'subscribers' => [],
        'connection' => [
            'driver' => 'pdo_pgsql',
            'host' => $_ENV['DB_HOST'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'dbname' => $_ENV['DB_NAME'],
            'charset' => 'utf-8',
            'default_table_options' => [
                'charset' => 'utf8',
                'collate' => 'utf8_unicode_ci'
            ]
        ],
    ]
];