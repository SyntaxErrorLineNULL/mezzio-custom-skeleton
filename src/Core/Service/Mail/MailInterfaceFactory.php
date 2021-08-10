<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\Mail;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

class MailInterfaceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Mailer
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Mailer
    {
        $config = $container->get('config')['mailer'];

        $dns = sprintf(
            '%s://%s:%s@%s:%s',
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password'],
            $config['encryption']
        );
        return new Mailer(Transport::fromDsn($dns));
    }
}