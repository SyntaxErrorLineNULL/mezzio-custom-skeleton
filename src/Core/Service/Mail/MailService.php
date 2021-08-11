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

    public function send(string $email, string $body): void
    {
        $message = (new \Swift_Message())
            ->setFrom('cyberorange16@gmail.com')
            ->setTo($email)
            ->setBody($body)
        ;
        $this->mailer->send($message);
    }
}