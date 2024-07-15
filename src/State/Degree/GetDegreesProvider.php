<?php

declare(strict_types=1);

namespace App\State\Degree;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\DegreeDto;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class GetDegreesProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $provider,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var \App\Entity\Degree[] */
        $degrees = $this->provider->provide($operation, $uriVariables, $context);

        foreach ($degrees as $degree) {
            $degreesDto[] = new DegreeDto($degree);
        }

        return $degreesDto ?? [];
    }
}
