<?php

namespace App\Entity;

use App\Repository\SmartphoneRepository;
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
}
