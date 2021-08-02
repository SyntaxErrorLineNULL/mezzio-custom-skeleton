<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Api;

use SELN\App\Core\Authentication\JWTService;
use SELN\App\Core\Factory\JWTServiceFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    JWTService::class => JWTServiceFactory::class,
                ]
            ]
        ];
    }
}