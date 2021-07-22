<?php

declare(strict_types=1);

namespace SELN\App\Application;

use Doctrine\ORM\EntityManagerInterface;
use SELN\App\Application\Infrastructure\EntityManagerFactory;
use SELN\App\Application\Infrastructure\Flusher;
use SELN\App\Application\Infrastructure\FlusherFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    EntityManagerInterface::class => EntityManagerFactory::class,
                    
                    
                    Flusher::class => FlusherFactory::class
                ]
            ]
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [

            ],
            'factories'  => [

            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
