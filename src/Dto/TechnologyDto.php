<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Technology;
use Symfony\Component\Serializer\Attribute\Groups;

#[Groups(SerializationGroups::EXPERIENCE_READ_COLLECTION)]
final class TechnologyDto
{
    #[Groups([
        SerializationGroups::TECHNOLOGY_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM,
    ])]
    public readonly int $id;

    #[Groups([
        SerializationGroups::TECHNOLOGY_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM,
    ])]
    public readonly string $name;

    #[Groups([
        SerializationGroups::TECHNOLOGY_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_COLLECTION,
        SerializationGroups::PROJECT_READ_ITEM,
    ])]
    public readonly string $type;

    public readonly ?bool $showInOverview;

    public function __construct(Technology $technology, array $options = [])
    {
        $this->id = $technology->getId();
        $this->name = $technology->getName();
        $this->type = $technology->getTechnologyType()->getName();

        $this->showInOverview = $options['showInOverview'] ?? null;
    }
}
