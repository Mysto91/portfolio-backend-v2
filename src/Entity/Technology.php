<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Constants\SerializationGroups;
use App\Dto\TechnologyDto;
use App\Repository\TechnologyRepository;
use App\State\Technology\GetTechnologiesProvider;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TechnologyRepository::class)]
#[ApiResource(
    output: TechnologyDto::class,
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => [SerializationGroups::TECHNOLOGY_READ_COLLECTION]],
            provider: GetTechnologiesProvider::class,
        ),
    ],
)]
class Technology
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true, unique: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[ORM\ManyToOne(inversedBy: 'technologies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TechnologyType $technologyType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getTechnologyType(): ?TechnologyType
    {
        return $this->technologyType;
    }

    public function setTechnologyType(?TechnologyType $technologyType): static
    {
        $this->technologyType = $technologyType;

        return $this;
    }
}
