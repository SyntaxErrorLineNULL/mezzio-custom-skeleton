<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\Mail;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class SwiftMailerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): \Swift_Mailer
    {
        $transport = $container->get(\Swift_SmtpTransport::class);
        return new \Swift_Mailer($transport);
    }
}