<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Project;
use App\Entity\Technology;
use Symfony\Component\Serializer\Attribute\Groups;

final class ProjectDto
{
    public $id;

    #[Groups([
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM
    ])]
    public $uuid;

    #[Groups([
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM
    ])]
    public $title;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    public $description;

    #[Groups([
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM
    ])]
    public $appUrl;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    public $githubUrl;

    #[Groups([
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM
    ])]
    public $overview;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    public $credits;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    public $mainImageUrl;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    public $firstImageUrl;

    #[Groups(SerializationGroups::PROJECT_READ_ITEM)]
    public $secondImageUrl;

    #[Groups([
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM
    ])]
    public $technologies;

    public function __construct(Project $project)
    {
        $this->id = $project->getId();
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
        $this->technologies = $project->getTechnologies()->map(fn($technology) => $this->normalizeTechnology($technology));
    }

    //TODO : Voir si c'est possible de faire mieux
    private function normalizeTechnology(Technology $technology): array
    {
        return [
            'id' => $technology->getId(),
            'name' => $technology->getName(),
            'type' => $technology->getTechnologyType()->getName(),
            'url' => $technology->getUrl(),
        ];
    }
}
