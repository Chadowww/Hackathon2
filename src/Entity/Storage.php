<?php

namespace App\Entity;

use App\Repository\StorageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'storage', targetEntity: Smartphone::class)]
    private Collection $smartphones;

    public function __construct()
    {
        $this->smartphones = new ArrayCollection();
    }

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
            $smartphone->setStorage($this);
        }

        return $this;
    }

    public function removeSmartphone(Smartphone $smartphone): static
    {
        if ($this->smartphones->removeElement($smartphone)) {
            // set the owning side to null (unless already changed)
            if ($smartphone->getStorage() === $this) {
                $smartphone->setStorage(null);
            }
        }

        return $this;
    }
}
