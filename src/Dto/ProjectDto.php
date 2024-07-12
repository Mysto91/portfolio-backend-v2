<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Project;
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
    public readonly string $appUrl;

    public readonly string $githubUrl;

    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    public readonly string $overview;

    public readonly ?string $credits;

    public readonly ?string $mainImageUrl;

    public readonly ?string $firstImageUrl;

    public readonly ?string $secondImageUrl;

    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    /**
     * @var TechnologyDto[]
     */
    public readonly array $technologies;

    public function __construct(Project $project)
    {
        $this->uuid = $project->getUuid();
        $this->title = $project->getTitle();
        $this->description = $project->getDescription();
        $this->appUrl = $project->getAppUrl();
        $this->githubUrl = $project->getGithubUrl();
        $this->overview = $project->getOverview();
        $this->credits = $project->getCredits();
        $this->mainImageUrl = $project->getMainImageUrl();
        $this->firstImageUrl = $project->getFirstImageUrl();
        $this->secondImageUrl = $project->getSecondImageUrl();
        $this->technologies = $project->getTechnologies()->map(fn($technology) => new TechnologyDto($technology));
    }
}
