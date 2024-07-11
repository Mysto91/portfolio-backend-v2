<?php

declare(strict_types=1);

namespace App\State\Technology;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\TechnologyDto;
use App\Entity\Technology;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class GetTechnologiesProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $provider,
    ) {
    }

    /**
     * @return TechnologyDto[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var Technology[] */
        $technologies = $this->provider->provide($operation, $uriVariables, $context);

        foreach ($technologies as $technology) {
            $technologiesDto[] = new TechnologyDto($technology);
        }

        return $technologiesDto ?? [];
    }
}
