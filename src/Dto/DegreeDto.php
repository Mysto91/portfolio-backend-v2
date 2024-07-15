<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Degree;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

#[Groups(SerializationGroups::DEGREE_READ_COLLECTION)]
final class DegreeDto
{
    public readonly Uuid $uuid;

    public readonly string $title;

    public readonly ?string $description;

    public readonly ?\DateTimeInterface $graduatedDate;

    public readonly CompanyDto $company;

    public function __construct(Degree $degree)
    {
        $this->uuid = $degree->getUuid();
        $this->title = $degree->getTitle();
        $this->description = $degree->getDescription();
        $this->graduatedDate = $degree->getGraduatedDate();
        $this->company = new CompanyDto($degree->getCompany());
    }
}
