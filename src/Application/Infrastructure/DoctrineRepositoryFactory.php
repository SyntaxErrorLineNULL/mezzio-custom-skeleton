<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Application\Infrastructure;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DoctrineRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ObjectRepository
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ObjectRepository
    {
        $entityRepository = str_replace(["\\Repository\\", "Repository"], ["\\Entity\\", ""], $requestedName);

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);

        return $entityManager->getRepository($entityRepository);
    }
}