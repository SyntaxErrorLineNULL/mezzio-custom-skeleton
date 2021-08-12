<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

use Twig\Loader\FilesystemLoader;

return [
    'twig' => [
        'debug' => true,
        'charset' => 'UTF-8',
        'strict_variables' => false,
        'autoescape' => 'html',
        'template_path' => [
            FilesystemLoader::MAIN_NAMESPACE => __DIR__ . '../../template'
        ],
        'cache_dir' => __DIR__ . '../../data/twig/cache'
    ]
];