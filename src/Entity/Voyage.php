<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoyageRepository")
 */
class Voyage
{
   use BaseEntityTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_de_voyage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_de_km_parcourues;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="voyages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_destination;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Portfolio", mappedBy="id_voyage", orphanRemoval=true)
     */
    private $portfolios;

    public function __construct()
    {
        $this->portfolios = new ArrayCollection();
    }


    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDeVoyage(): ?\DateTimeInterface
    {
        return $this->date_de_voyage;
    }

    public function setDateDeVoyage(\DateTimeInterface $date_de_voyage): self
    {
        $this->date_de_voyage = $date_de_voyage;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getNbDeKmParcourues(): ?int
    {
        return $this->nb_de_km_parcourues;
    }

    public function setNbDeKmParcourues(?int $nb_de_km_parcourues): self
    {
        $this->nb_de_km_parcourues = $nb_de_km_parcourues;

        return $this;
    }

    public function getIdDestination(): ?Destination
    {
        return $this->id_destination;
    }

    public function setIdDestination(?Destination $id_destination): self
    {
        $this->id_destination = $id_destination;

        return $this;
    }

    /**
     * @return Collection|Portfolio[]
     */
    public function getPortfolios(): Collection
    {
        return $this->portfolios;
    }

    public function addPortfolio(Portfolio $portfolio): self
    {
        if (!$this->portfolios->contains($portfolio)) {
            $this->portfolios[] = $portfolio;
            $portfolio->setIdVoyage($this);
        }

        return $this;
    }

    public function removePortfolio(Portfolio $portfolio): self
    {
        if ($this->portfolios->contains($portfolio)) {
            $this->portfolios->removeElement($portfolio);
            // set the owning side to null (unless already changed)
            if ($portfolio->getIdVoyage() === $this) {
                $portfolio->setIdVoyage(null);
            }
        }

        return $this;
    }
}
