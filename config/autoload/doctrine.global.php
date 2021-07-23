<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

return [
    'doctrine' => [
        'cache_dir' => __DIR__ . '../../data/doctrine/cache',
        'proxy_dir' => __DIR__ . '../../data/doctrine',
        'proxy_namespace' => 'SELN\\App\\Doctrine\\Proxy\\',
        'simpleAnnotationReader' => false,

        // you should add any other path containing annotated entity classes
        # TODO: fix metadata
        'metadata_dirs' => [__DIR__ . '../../src/Application/Domain'],
        'subscribers' => [],
        'connection' => [
            'driver' => 'pdo_pgsql',
            'host' => getenv('DB_HOST'),
            'user' => getenv('DB_USER'),
            'password' => getenv('DB_PASSWORD'),
            'dbname' => getenv('DB_NAME'),
            'charset' => 'utf-8',
            'default_table_options' => [
                'charset' => 'utf8',
                'collate' => 'utf8_unicode_ci'
            ]
        ],
    ]
];