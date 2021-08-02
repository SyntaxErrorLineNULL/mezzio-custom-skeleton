<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Validator;

use Interop\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Symfony\Component\Validator\ValidatorBuilder;

class ValidatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ValidatorBuilder
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ValidatorBuilder
    {
        return Validation::createValidatorBuilder();
    }
}