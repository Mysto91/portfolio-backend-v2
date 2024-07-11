<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\ProjectDto;
use App\Entity\Project;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class GetProjectProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.item_provider')]
        private ProviderInterface $provider,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ProjectDto
    {
        /** @var Project */
        $project = $this->provider->provide($operation, $uriVariables, $context);

        return new ProjectDto($project);
    }
}