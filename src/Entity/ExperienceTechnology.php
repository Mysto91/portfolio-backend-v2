<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ExperienceTechnologyRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use App\Entity\Technology;

#[ORM\Entity(repositoryClass: ExperienceTechnologyRepository::class)]
class ExperienceTechnology
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Experience::class)]
    #[ORM\JoinColumn(name: 'experience_id', referencedColumnName: 'id')]
    private Experience $experience;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Technology::class)]
    #[ORM\JoinColumn(name: 'technology_id', referencedColumnName: 'id')]
    private Technology $technology;

    #[ORM\Column(options: ['default' => true])]
    private bool $showInOverview;

    public function isShowInOverview(): bool
    {
        return $this->showInOverview;
    }

    public function setShowInOverview(bool $showInOverview): static
    {
        $this->showInOverview = $showInOverview;

        return $this;
    }
}
