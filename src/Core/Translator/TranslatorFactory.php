<?php

/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Translator;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Translator
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Translator
    {
        $config = $container->get('config')['translator'];

        $translator = new Translator($config['lang']);
        $translator->addLoader('xlf', new XliffFileLoader());

        foreach ($config['resources'] as $resource) {
            $translator->addResource(...$resource);
        }

        return $translator;
    }
}