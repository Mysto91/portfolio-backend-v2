<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CompanyRepository;
use App\Constants\SerializationGroups;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups([
        SerializationGroups::DEGREE_READ_COLLECTION,
        SerializationGroups::EXPERIENCE_READ_COLLECTION
    ])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([
        SerializationGroups::DEGREE_READ_COLLECTION,
        SerializationGroups::EXPERIENCE_READ_COLLECTION
    ])]
    private ?string $url = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups([
        SerializationGroups::DEGREE_READ_COLLECTION,
        SerializationGroups::EXPERIENCE_READ_COLLECTION
    ])]
    private ?string $logo = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups([
        SerializationGroups::DEGREE_READ_COLLECTION,
        SerializationGroups::EXPERIENCE_READ_COLLECTION
    ])]
    private ?string $logoClass = null;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLogoClass(): ?string
    {
        return $this->logoClass;
    }

    public function setLogoClass(?string $logoClass): static
    {
        $this->logoClass = $logoClass;

        return $this;
    }
}
