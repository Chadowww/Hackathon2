<?php

namespace App\Entity;

use App\Repository\MemoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: MemoryRepository::class)]
class Memory
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $ramNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $valueMemory = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRamNumber(): ?int
    {
        return $this->ramNumber;
    }

    public function setRamNumber(?int $ramNumber): static
    {
        $this->ramNumber = $ramNumber;

        return $this;
    }

    public function getValueMemory(): ?int
    {
        return $this->valueMemory;
    }

    public function setValueMemory(?int $valueM): static
    {
        $this->valueMemory = $valueM;

        return $this;
    }

}
