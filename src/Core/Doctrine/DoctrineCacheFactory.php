<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Doctrine;

use Doctrine\Common\Cache\Cache;
use Interop\Container\ContainerInterface;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class DoctrineCacheFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Cache
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Cache
    {
        $config = $container->get('config');
        return $config[ConfigAggregator::ENABLE_CACHE] ?
            DoctrineProvider::wrap(new FilesystemAdapter('', 0, $config['doctrine']['cache_dir'])) :
            DoctrineProvider::wrap(new ArrayAdapter());

    }
}