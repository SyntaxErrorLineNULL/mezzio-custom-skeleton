<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\Mail;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Swift_SmtpTransport;

class TransportFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Swift_SmtpTransport
    {
        $config = $container->get('config')['mailer'];
        return (new Swift_SmtpTransport($config['host'], $config['port']))
            ->setUsername($config['user'])
            ->setPassword($config['password'])
            ->setEncryption($config['encryption']);
    }
}