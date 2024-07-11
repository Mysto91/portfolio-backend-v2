<?php

declare(strict_types=1);

namespace App\Identifier;

use ApiPlatform\Api\UriVariableTransformerInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Uid\Uuid;

final class UuidUriVariableTransformer implements UriVariableTransformerInterface
{
    /**
     * Transforms a uri variable value.
     *
     * @param mixed $value   The uri variable value to transform
     * @param array $types   The guessed type behind the uri variable
     * @param array $context Options available to the transformer
     *
     * @throws InvalidArgumentException
     */
    public function transform($value, array $types, array $context = []): Uuid
    {
        try {
            return Uuid::fromString($value);
        } catch (\InvalidArgumentException $e) {
            throw new BadRequestException($e->getMessage());
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }

    /**
     * Checks whether the given uri variable is supported for transformation by this transformer.
     *
     * @param mixed $value   The uri variable value to transform
     * @param array $types   The types to which the data should be transformed
     * @param array $context Options available to the transformer
     */
    public function supportsTransformation($value, array $types, array $context = []): bool
    {
        foreach ($types as $type) {
            if (is_a($type, Uuid::class, true)) {
                return true;
            }
        }

        return false;
    }
}
