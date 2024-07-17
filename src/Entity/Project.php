<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use App\Constants\SerializationGroups;
use App\Dto\ProjectDto;
use App\Repository\ProjectRepository;
use App\State\GetProjectProvider;
use App\State\Project\GetProjectsProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ApiResource(
    output: ProjectDto::class,
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => [SerializationGroups::PROJECT_READ_COLLECTION]],
            provider: GetProjectsProvider::class,
        ),
        new Get(
            normalizationContext: ['groups' => [SerializationGroups::PROJECT_READ_ITEM]],
            provider: GetProjectProvider::class,
        ),
    ],
    paginationEnabled: true,
)]
#[ApiFilter(SearchFilter::class,
    properties: [
        'title' => 'ipartial',
        'technologies.name' => 'ipartial',
    ],
)]
class Project
{
    use TimestampableEntity;

    #[ORM\Id, ORM\GeneratedValue, ORM\Column]
    #[ApiProperty(identifier: false)]
    private int $id;

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[ApiProperty(identifier: true)]
    private Uuid $uuid;

    #[ORM\Column(length: 100)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $appUrl = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $githubUrl = null;

    #[ORM\Column(length: 100)]
    private string $overview;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $credits = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $mainImageUrl = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $firstImageUrl = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $secondImageUrl = null;

    /**
     * @var Collection<int, Technology>
     */
    #[ORM\ManyToMany(targetEntity: Technology::class, inversedBy: 'projects')]
    private Collection $technologies;

    /**
     * @var Collection<int, Functionality>
     */
    #[ORM\OneToMany(targetEntity: Functionality::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $functionalities;

    public function __construct()
    {
        $this->technologies = new ArrayCollection();
        $this->functionalities = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Technology>
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technology $technology): static
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies->add($technology);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): static
    {
        $this->technologies->removeElement($technology);

        return $this;
    }

    /**
     * @return Collection<int, Functionality>
     */
    public function getFunctionalities(): Collection
    {
        return $this->functionalities;
    }

    public function addFunctionality(Functionality $functionality): static
    {
        if (!$this->functionalities->contains($functionality)) {
            $this->functionalities->add($functionality);
            $functionality->setProject($this);
        }

        return $this;
    }

    public function removeFunctionality(Functionality $functionality): static
    {
        $this->functionalities->removeElement($functionality);

        return $this;
    }
}
