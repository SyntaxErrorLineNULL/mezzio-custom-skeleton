<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core;


use Doctrine\ORM\EntityManagerInterface;
use SELN\App\Core\Doctrine\EntityManagerFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    EntityManagerInterface::class => EntityManagerFactory::class
                ]
            ]
        ];
    }

}