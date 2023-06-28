<?php

namespace App\Entity;

use App\Repository\YearRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: YearRepository::class)]
class Year
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ReleaseDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $valueYear = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->ReleaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $ReleaseDate): static
    {
        $this->ReleaseDate = $ReleaseDate;

        return $this;
    }

    public function getvalueYear(): ?int
    {
        return $this->valueYear;
    }

    public function setvalueYear(?int $valueYear): static
    {
        $this->valueYear = $valueYear;

        return $this;
    }
}
