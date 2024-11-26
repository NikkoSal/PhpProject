<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'portfolios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    /**
     * @var Collection<int, Dipositary>
     */
    #[ORM\OneToMany(targetEntity: Dipositary::class, mappedBy: 'portfolio')]
    private Collection $dipositaries;

    public function __construct()
    {
        $this->dipositaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Dipositary>
     */
    public function getDipositaries(): Collection
    {
        return $this->dipositaries;
    }

    public function addDipositary(Dipositary $dipositary): static
    {
        if (!$this->dipositaries->contains($dipositary)) {
            $this->dipositaries->add($dipositary);
            $dipositary->setPortfolio($this);
        }

        return $this;
    }

    public function removeDipositary(Dipositary $dipositary): static
    {
        if ($this->dipositaries->removeElement($dipositary)) {
            // set the owning side to null (unless already changed)
            if ($dipositary->getPortfolio() === $this) {
                $dipositary->setPortfolio(null);
            }
        }

        return $this;
    }
}
