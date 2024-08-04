<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Validator\ValidatorInterface;
use App\ApiResource\Mail;
use App\Service\MailerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MailStateProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly MailerService $mailerService,
        private readonly ValidatorInterface $validator
    ) {
    }

    /**
     * @param Mail $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JsonResponse
    {
        $errors = $this->validator->validate($data) ?? [];

        if (count($errors) > 0) {
            throw new BadRequestHttpException((string) $errors);
        }

        $this->mailerService->sendEmail(
            to: $data->to,
            subject: $data->subject,
            content: $data->content,
            from: $data->from ?? null,
            fromContact: $data->fromContact ?? null,
        );

        return new JsonResponse(['message' => 'Email sent successfully!'], Response::HTTP_CREATED);
    }
}
