<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

return [
    'doctrine' => [
        'development' => true,
        // if true, metadata caching is forcefully disabled
        'dev_mode' => true,
        'cache_dir' => __DIR__ . '',
        'proxy_dir' => __DIR__ . '../../data/doctrine',
        'simpleAnnotationReader' => false,

        // you should add any other path containing annotated entity classes
        'metadata_dirs' => [__DIR__ . '/../../src/Application/Domain'],
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