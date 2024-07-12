<?php

namespace App\Dto;

use App\Constants\SerializationGroups;
use App\Entity\Company;
use App\Entity\Experience;
use App\Enums\ContractType;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[Groups(SerializationGroups::EXPERIENCE_READ_COLLECTION)]
final class ExperienceDto
{
    public readonly Uuid $uuid;

    public readonly string $position;

    public readonly string $overview;

    public readonly ?string $description;

    public readonly \DateTimeInterface $startDate;

    public readonly ?\DateTimeInterface $endDate;

    public readonly Company $company;

    public readonly ContractType $contractType;

    /**
     * @var TechnologyDto[]
     */
    public readonly array $technologies;

    public function __construct(Experience $experience, array $technologies = [])
    {
        $this->uuid = $experience->getUuid();
        $this->position = $experience->getPosition();
        $this->overview = $experience->getOverview();
        $this->description = $experience->getDescription();
        $this->startDate = $experience->getStartDate();
        $this->endDate = $experience->getEndDate();
        $this->contractType = $experience->getContractType();
        $this->company = $experience->getCompany();

        foreach ($technologies as $technology) {
            $this->technologies[] = new TechnologyDto(
                technology: $technology['technology'],
                options: ['showInOverview' => $technology['showInOverview']]
            );
        }
    }
}

