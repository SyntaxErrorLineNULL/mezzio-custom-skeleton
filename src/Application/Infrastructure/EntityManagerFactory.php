<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Infrastructure;


use Doctrine\Common\EventManager;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMException;
use Interop\Container\ContainerInterface;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ServiceManager\Factory\FactoryInterface;

class EntityManagerFactory implements FactoryInterface
{

    /**
     * @throws ORMException
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): EntityManager
    {
        # https://www.doctrine-project.org/projects/doctrine-orm/en/2.9/reference/advanced-configuration.html - example

        $setting = $container->get('config');

        $configurator = new Configuration();
        $configurator->setProxyDir($setting['doctrine']['proxy_dir']);
        $configurator->setProxyNamespace($setting['doctrine']['proxy_namespace']);

        $configurator->setMetadataDriverImpl(new AttributeDriver(['src/Application/Domain']));
        /*$setMetadataDriverImpl = $configurator->newDefaultAnnotationDriver(['src/Application/Domain'], $setting['doctrine']['simpleAnnotationReader']);
        $configurator->setMetadataDriverImpl($setMetadataDriverImpl);*/

        $configurator->setNamingStrategy(new UnderscoreNamingStrategy(CASE_LOWER, true));

        /*$configurator->setAutoGenerateProxyClasses(
            (bool)$setting[ConfigAggregator::ENABLE_CACHE]
        );*/

        $eventManager = new EventManager();

        foreach ($setting['doctrine']['subscribers'] as $name) {
            /** @var EventSubscriber $subscriber */
            $subscriber = $container->get($name);
            $eventManager->addEventSubscriber($subscriber);
        }

        return EntityManager::create($setting['doctrine']['connection'], $configurator, $eventManager);
    }
}