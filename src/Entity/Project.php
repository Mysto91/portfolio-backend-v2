<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Constants\SerializationGroups;
use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => [SerializationGroups::PROJECT_READ_COLLECTION]],
    operations: [
        new GetCollection()
    ],
    paginationEnabled: true,
)]
class Project
{
    use TimestampableEntity;

    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 100)]
    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    private ?string $appUrl = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $githubUrl = null;

    #[ORM\Column(length: 100)]
    #[Groups(SerializationGroups::PROJECT_READ_COLLECTION)]
    private ?string $overview = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $credits = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $mainImageUrl = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $firstImageUrl = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $secondImageUrl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
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

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAppUrl(): ?string
    {
        return $this->appUrl;
    }

    public function setAppUrl(?string $appUrl): static
    {
        $this->appUrl = $appUrl;

        return $this;
    }

    public function getGithubUrl(): ?string
    {
        return $this->githubUrl;
    }

    public function setGithubUrl(?string $githubUrl): static
    {
        $this->githubUrl = $githubUrl;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getCredits(): ?string
    {
        return $this->credits;
    }

    public function setCredits(?string $credits): static
    {
        $this->credits = $credits;

        return $this;
    }

    public function getMainImageUrl(): ?string
    {
        return $this->mainImageUrl;
    }

    public function setMainImageUrl(?string $mainImageUrl): static
    {
        $this->mainImageUrl = $mainImageUrl;

        return $this;
    }

    public function getFirstImageUrl(): ?string
    {
        return $this->firstImageUrl;
    }

    public function setFirstImageUrl(string $firstImageUrl): static
    {
        $this->firstImageUrl = $firstImageUrl;

        return $this;
    }

    public function getSecondImageUrl(): ?string
    {
        return $this->secondImageUrl;
    }

    public function setSecondImageUrl(?string $secondImageUrl): static
    {
        $this->secondImageUrl = $secondImageUrl;

        return $this;
    }
}
