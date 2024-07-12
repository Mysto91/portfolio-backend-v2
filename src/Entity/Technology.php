<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Constants\SerializationGroups;
use App\Dto\TechnologyDto;
use App\Repository\TechnologyRepository;
use App\State\Technology\GetTechnologiesProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

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

    #[ORM\ManyToOne(inversedBy: 'technologies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TechnologyType $technologyType = null;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'technologies')]
    private Collection $projects;

    #[ORM\OneToMany(targetEntity: ExperienceTechnology::class, mappedBy: 'technology')]
    private Collection $experienceTechnologies;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

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

    public function getTechnologyType(): ?TechnologyType
    {
        return $this->technologyType;
    }

    public function setTechnologyType(?TechnologyType $technologyType): static
    {
        $this->technologyType = $technologyType;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addTechnology($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeTechnology($this);
        }

        return $this;
    }
}
