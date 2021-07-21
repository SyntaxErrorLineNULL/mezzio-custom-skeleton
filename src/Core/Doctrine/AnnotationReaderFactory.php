<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Doctrine;


use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\Cache;
use Interop\Container\ContainerInterface;
use Doctrine\Common\Annotations\Reader;

class AnnotationReaderFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Reader
    {
        AnnotationRegistry::registerLoader('class_exists');
        return new CachedReader(new AnnotationReader(), $container->get(Cache::class));
    }
}