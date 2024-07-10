<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Constants\SerializationGroups;
use App\Repository\DegreeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DegreeRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => [SerializationGroups::DEGREE_READ_COLLECTION]],
    operations: [
        new GetCollection()
    ],
    paginationEnabled: false,
)]
class Degree
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(SerializationGroups::DEGREE_READ_COLLECTION)]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 50)]
    #[Groups(SerializationGroups::DEGREE_READ_COLLECTION)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(SerializationGroups::DEGREE_READ_COLLECTION)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(SerializationGroups::DEGREE_READ_COLLECTION)]
    private ?\DateTimeInterface $graduatedDate = null;

    #[ORM\ManyToOne]
    #[Groups(SerializationGroups::DEGREE_READ_COLLECTION)]
    private ?Company $company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getGraduatedDate(): ?\DateTimeInterface
    {
        return $this->graduatedDate;
    }

    public function setGraduatedDate(?\DateTimeInterface $graduatedDate): static
    {
        $this->graduatedDate = $graduatedDate;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }
}
