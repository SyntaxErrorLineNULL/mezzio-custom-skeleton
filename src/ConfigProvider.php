<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App;


use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use SELN\App\Core\Doctrine\AnnotationReaderFactory;
use SELN\App\Core\Doctrine\DoctrineCacheFactory;
use SELN\App\Core\Translator\TranslatorFactory;
use SELN\App\Core\Validator\ValidatorFactory;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Common\Cache\Cache;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        /**
         * Returns the configuration array
         *
         * To add a bit of a structure, each section is defined in a separate
         * method which returns an array with its configuration.
         */
        return [
            'dependencies' => [
                'abstract_factories' => [ReflectionBasedAbstractFactory::class],
                'factories' => [
                    Reader::class => AnnotationReaderFactory::class,
                    Translator::class => TranslatorFactory::class,
                    ValidatorInterface::class => ValidatorFactory::class,
                    Cache::class => DoctrineCacheFactory::class,
                ],
                'aliases' => [],
            ],
            'validators' => [
                'abstract_factories' => [ReflectionBasedAbstractFactory::class]
            ]
        ];
    }

}