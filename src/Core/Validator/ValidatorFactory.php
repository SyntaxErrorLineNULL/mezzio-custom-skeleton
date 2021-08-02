<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Validator;

use Doctrine\Common\Annotations\Reader;
use Interop\Container\ContainerInterface;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\ContainerConstraintValidatorFactory;
use Symfony\Component\Validator\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Validator\Validation;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ValidatorInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ValidatorInterface
    {
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->addLoader(new AnnotationLoader($container->get(Reader::class)))
            ->setConstraintValidatorFactory(new ContainerConstraintValidatorFactory($container))
            ->setTranslator($container->get(Translator::class))
            ->setTranslationDomain('validators')
            ->getValidator();
    }
}