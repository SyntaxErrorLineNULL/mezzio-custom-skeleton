<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Factory;


use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use SELN\App\Core\Authentication\JWTService;

class JWTServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return JWTService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): JWTService
    {
        $config = $container->get('config')['jwt'];
        return new JWTService($config['secret'], $config['algorithm']);
    }
}