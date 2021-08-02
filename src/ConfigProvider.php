<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App;


use Doctrine\Common\Annotations\Reader;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use SELN\App\Core\Doctrine\AnnotationReaderFactory;
use SELN\App\Core\Translator\TranslatorFactory;
use Symfony\Component\Translation\Translator;

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
                'factories' => [
                    Reader::class => AnnotationReaderFactory::class,
                    Translator::class => TranslatorFactory::class
                ],
                'aliases' => [

                ],
                'abstract_factories' => [
                    ReflectionBasedAbstractFactory::class
                ]
            ],
            'validators' => [

            ]
        ];
    }

}