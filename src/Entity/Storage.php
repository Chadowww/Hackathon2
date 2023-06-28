<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: StorageRepository::class)]
class Storage
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $goStorage = null;

    #[ORM\Column(nullable: true)]
    private ?int $valueStorage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGoStorage(): ?int
    {
        return $this->goStorage;
    }

    public function setGoStorage(?int $goStorage): static
    {
        $this->goStorage = $goStorage;

        return $this;
    }

    public function getValueStorage(): ?int
    {
        return $this->valueStorage;
    }

    public function setValueStorage(?int $valueStorage): static
    {
        $this->valueStorage = $valueStorage;

        return $this;
    }
}
