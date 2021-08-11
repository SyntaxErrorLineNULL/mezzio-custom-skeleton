<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\Mail;


use Swift_Mailer;
use Swift_Message;
use Swift_RfcComplianceException;

class MailService
{
    public function __construct(private Swift_Mailer $mailer) {}

    public function send(string $email, string $body): void
    {
        $message = (new Swift_Message())
            ->setFrom('cyberorange16@gmail.com')
            ->setTo($email)
            ->setBody($body);

        if ($this->mailer->send($message) === 0) {
            throw new MailSendException("Unable to send email to this ${$email} email address.");
        }
    }
}