<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\Mail;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{

    public function __construct(
        private \Swift_Mailer $mailer
    ) {}

    public function send(string $email, string $message): void
    {
        $message = (new \Swift_Message())
            ->setFrom()
            ->setTo()
            ->setBody('hello')
        ;
        $this->mailer->send();
    }
}