<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Project;
use App\Dto\FunctionalityDto;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[Groups(SerializationGroups::PROJECT_READ_ITEM)]
final class ProjectDto
{
    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    public readonly Uuid $uuid;

    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    public readonly string $title;

    public readonly string $description;

    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    public readonly ?string $appUrl;

    public readonly ?string $githubUrl;

    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    public readonly string $overview;

    public readonly ?string $credits;

    public readonly array $images;

    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    /**
     * @var TechnologyDto[]
     */
    public readonly array $technologies;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    /**
     * @var FunctionalityDto[]
     */
    public readonly array $functionalities;

    public function __construct(Project $project)
    {
        $this->uuid = $project->getUuid();
        $this->title = $project->getTitle();
        $this->description = $project->getDescription();
        $this->appUrl = $project->getAppUrl();
        $this->githubUrl = $project->getGithubUrl();
        $this->overview = $project->getOverview();
        $this->credits = $project->getCredits();
        $this->images = [
            $this->normalizeImage('main_image_url', $project->getMainImageUrl()),
            $this->normalizeImage('first_image_url', $project->getFirstImageUrl()),
            $this->normalizeImage('second_image_url', $project->getSecondImageUrl()),
        ];
        $this->technologies = $project->getTechnologies()->map(fn($technology) => new TechnologyDto($technology))->toArray();
        $this->functionalities = $project->getFunctionalities()->map(fn ($functionality) => new FunctionalityDto($functionality))->toArray();
    }

    private function normalizeImage(string $type, ?string $url): array
    {
        return [
            'type' => $type,
            'url' => $url,
        ];
    }

}
