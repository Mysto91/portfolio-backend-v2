<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\State\MailStateProcessor;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: 'send-email',
            processor: MailStateProcessor::class,
        )
    ]
)]
class Mail
{
    #[Assert\Email]
    public ?string $from;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $to;

    #[Assert\NotBlank]
    public string $subject;

    #[Assert\Email]
    public ?string $fromContact;

    #[Assert\NotBlank]
    public string $content;
}
