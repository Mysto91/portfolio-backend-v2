<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(
        private readonly MailerInterface $mailer,
        #[Autowire(env: 'SENDER_EMAIL')]
        private readonly string $senderEmail,
    ) {
    }

    public function sendEmail(
        string $to,
        string $subject,
        string $content,
        string $from = null,
        string $fromContact = null,
    ): void {
        $email = (new Email())
            ->from($from ?? $this->senderEmail)
            ->to($to)
            ->subject($subject);

        $text = $content;

        if ($fromContact) {
            $text .= "\nEmail du contact : ${fromContact}";
        }

        $email->text($text);

        $this->mailer->send($email);
    }
}
