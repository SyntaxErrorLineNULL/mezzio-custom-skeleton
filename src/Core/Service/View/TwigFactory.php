<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\View;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;

class TwigFactory implements FactoryInterface
{

    /**
     * @throws LoaderError
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Environment
    {
        $config = $container->get('config')['twig'];
        $loader = new FilesystemLoader();

        foreach ($config['template_path'] as $alias => $path) {
            $loader->addPath($path, $alias);
        }

        return new Environment(
            $loader, [
                'debug' => $config['debug'],
                'charset' => $config['charset'],
                'strict_variables' => $config['strict_variables'],
                'autoescape' => $config['autoescape'],
                'cache' => $config['debug'] ? false : $config['cache_dir'],
                'auto_reload' => $config['debug']
            ]
        );
    }
}