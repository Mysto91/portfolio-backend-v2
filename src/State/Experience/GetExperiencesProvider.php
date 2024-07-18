<?php

declare(strict_types=1);

namespace App\State\Experience;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\ExperienceDto;
use App\Entity\Experience;
use App\Repository\TechnologyRepository;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class GetExperiencesProvider implements ProviderInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.collection_provider')]
        private ProviderInterface $provider,
        private TechnologyRepository $technologyRepository,
    ) {}

    /**
     * @return ExperienceDto[]
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        /** @var Experience[] */
        $experiences = $this->provider->provide($operation, $uriVariables, $context);

        foreach ($experiences as $experience) {
            $technologies = $this->technologyRepository->findTechnologiesByExperience($experience->getId());
            $experiencesDto[] = new ExperienceDto(experience: $experience, technologies: $technologies);
        }

        return $experiencesDto ?? [];
    }
}
