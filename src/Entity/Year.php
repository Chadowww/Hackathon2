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

    #[ORM\Column(nullable: true)]
    private ?int $phoneAge = null;

    #[ORM\Column(nullable: true)]
    private ?int $valueYear = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getPhoneAge(): ?int
    {
        return $this->phoneAge;
    }

    /**
     * @param int|null $phoneAge
     */
    public function setPhoneAge(?int $phoneAge): void
    {
        $this->phoneAge = $phoneAge;
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
