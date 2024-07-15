<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Functionality;
use Symfony\Component\Serializer\Annotation\Groups;

#[Groups(SerializationGroups::PROJECT_READ_ITEM)]
final class FunctionalityDto
{
    public readonly string $code;

    public readonly string $description;

    public function __construct(Functionality $functionality)
    {
        $this->code = $functionality->getCode();
        $this->description = $functionality->getDescription();
    }
}
