<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    /**
     * @var Collection<int, Degree>
     */
    #[ORM\ManyToMany(targetEntity: Degree::class, inversedBy: 'subjects')]
    private Collection $degrees;

    public function __construct()
    {
        $this->degrees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Degree>
     */
    public function getDegrees(): Collection
    {
        return $this->degrees;
    }

    public function addDegree(Degree $degree): static
    {
        if (!$this->degrees->contains($degree)) {
            $this->degrees->add($degree);
        }

        return $this;
    }

    public function removeDegree(Degree $degree): static
    {
        $this->degrees->removeElement($degree);

        return $this;
    }
}
