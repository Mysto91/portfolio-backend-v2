<?php

declare(strict_types=1);

namespace App\State\Project;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\ProjectDto;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use App\Entity\Project;

class GetProjectsProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $provider,
    ) {
    }

    /**
     * @return ProjectDto[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var Project[] */
        $projects = $this->provider->provide($operation, $uriVariables, $context);

        foreach ($projects as $project) {
            $projectsDto[] = new ProjectDto($project);
        }

        return $projectsDto ?? [];
    }
}
