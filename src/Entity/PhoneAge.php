<?php

namespace App\Entity;

use App\Repository\YearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: YearRepository::class)]
class PhoneAge
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

    #[ORM\OneToMany(mappedBy: 'year', targetEntity: Smartphone::class)]
    private Collection $smartphones;

    public function __construct()
    {
        $this->smartphones = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Smartphone>
     */
    public function getSmartphones(): Collection
    {
        return $this->smartphones;
    }

    public function addSmartphone(Smartphone $smartphone): static
    {
        if (!$this->smartphones->contains($smartphone)) {
            $this->smartphones->add($smartphone);
            $smartphone->setYear($this);
        }

        return $this;
    }

    public function removeSmartphone(Smartphone $smartphone): static
    {
        if ($this->smartphones->removeElement($smartphone)) {
            // set the owning side to null (unless already changed)
            if ($smartphone->getYear() === $this) {
                $smartphone->setYear(null);
            }
        }

        return $this;
    }
}
