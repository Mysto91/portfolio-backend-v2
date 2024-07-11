<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Technology;
use Symfony\Component\Serializer\Attribute\Groups;

final class TechnologyDto
{
    #[Groups(SerializationGroups::TECHNOLOGY_READ_COLLECTION)]
    public $id;

    #[Groups(SerializationGroups::TECHNOLOGY_READ_COLLECTION)]
    public $name;

    #[Groups(SerializationGroups::TECHNOLOGY_READ_COLLECTION)]
    public $url;

    #[Groups(SerializationGroups::TECHNOLOGY_READ_COLLECTION)]
    public $type;

    public function __construct(Technology $technology)
    {
        $this->id = $technology->getId();
        $this->name = $technology->getName();
        $this->url = $technology->getUrl();
        $this->type = $technology->getTechnologyType()->getName();
    }
}
