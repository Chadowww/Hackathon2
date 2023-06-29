<?php

namespace App\Entity;

use App\Repository\PhoneConditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'phoneCondition', targetEntity: Smartphone::class)]
    private Collection $smartphones;

    public function __construct()
    {
        $this->smartphones = new ArrayCollection();
    }

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
            $smartphone->setPhoneCondition($this);
        }

        return $this;
    }

    public function removeSmartphone(Smartphone $smartphone): static
    {
        if ($this->smartphones->removeElement($smartphone)) {
            // set the owning side to null (unless already changed)
            if ($smartphone->getPhoneCondition() === $this) {
                $smartphone->setPhoneCondition(null);
            }
        }

        return $this;
    }
}
