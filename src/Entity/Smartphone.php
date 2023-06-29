<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: SmartphoneRepository::class)]
class Smartphone
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $model = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isSold = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasCharger = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Memory $memory = null;

    #[ORM\ManyToOne(inversedBy: 'smartphones')]
    private ?Storage $storage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $release_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getmodel(): ?string
    {
        return $this->model;
    }

    public function setmodel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function isIsSold(): ?bool
    {
        return $this->isSold;
    }

    public function setIsSold(?bool $isSold): static
    {
        $this->isSold = $isSold;

        return $this;
    }

    public function isHasCharger(): ?bool
    {
        return $this->hasCharger;
    }

    public function setHasCharger(?bool $hasCharger): static
    {
        $this->hasCharger = $hasCharger;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }


    public function getMemory(): ?Memory
    {
        return $this->memory;
    }

    public function setMemory(?Memory $memory): static
    {
        $this->memory = $memory;

        return $this;
    }

    public function getStorage(): ?Storage
    {
        return $this->storage;
    }

    public function setStorage(?Storage $storage): static
    {
        $this->storage = $storage;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }
    public function __toString(): string
    {
        return $this->release_date->format('Y');
    }
}
