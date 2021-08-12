<?php
/**
 * Author: SyntaxErrorLineNULL.
 */

declare(strict_types=1);

namespace SELN\App\Core\Service\Mail;


use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MailService
{
    public function __construct(private Swift_Mailer $mailer, private Environment $twig) {}

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function send(string $toEmail, array $body, string $templatePath): void
    {
        $message = (new Swift_Message())
            ->setFrom(['cyberorange16@gmail.com' => 'Administrator'])
            ->setTo([$toEmail => 'User'])
            ->setBody($this->twig->render($templatePath, $body));

        if ($this->mailer->send($message) === 0) {
            throw new MailSendException("Unable to send email to this ${$toEmail} email address.");
        }
    }
}