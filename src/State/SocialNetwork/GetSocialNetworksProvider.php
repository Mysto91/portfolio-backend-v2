<?php

declare(strict_types=1);

namespace App\State\SocialNetwork;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\SocialNetworkDto;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class GetSocialNetworksProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $provider,
    ) {
    }

    /**
     * @return SocialNetworkDto[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var \App\Entity\SocialNetwork[] */
        $socialNetworks = $this->provider->provide($operation, $uriVariables, $context);

        foreach ($socialNetworks as $socialNetwork) {
            $socialNetworksDto[] = new SocialNetworkDto($socialNetwork);
        }

        return $socialNetworksDto ?? [];
    }
}
