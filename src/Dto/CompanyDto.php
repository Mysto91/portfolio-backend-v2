<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Company;
use Symfony\Component\Serializer\Annotation\Groups;

#[Groups([
    SerializationGroups::DEGREE_READ_COLLECTION,
    SerializationGroups::EXPERIENCE_READ_COLLECTION,
])]
final class CompanyDto
{
    public readonly string $name;

    public readonly ?string $url;

    public readonly ?string $logo;

    public readonly ?string $logoClass;

    public function __construct(Company $company)
    {
        $this->name = $company->getName();
        $this->url = $company->getUrl();
        $this->logo = $company->getLogo();
        $this->logoClass = $company->getLogoClass();
    }
}
