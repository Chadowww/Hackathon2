<?php

namespace App\Entity;

use App\Repository\PhoneConditionRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: PhoneConditionRepository::class)]
class PhoneCondition
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $overallCondition = null;

    #[ORM\Column(nullable: true)]
    private ?float $priceDepreciation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOverallCondition(): ?string
    {
        return $this->overallCondition;
    }

    public function setOverallCondition(?string $overallCondition): static
    {
        $this->overallCondition = $overallCondition;

        return $this;
    }

    public function getPriceDepreciation(): ?float
    {
        return $this->priceDepreciation;
    }

    public function setPriceDepreciation(?float $priceDepreciation): static
    {
        $this->priceDepreciation = $priceDepreciation;

        return $this;
    }
}
