<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortfolioRepository")
 */
class Portfolio
{
    use BaseEntityTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voyage", inversedBy="portfolios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_voyage;

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(string $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(?string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getIdVoyage(): ?Voyage
    {
        return $this->id_voyage;
    }

    public function setIdVoyage(?Voyage $id_voyage): self
    {
        $this->id_voyage = $id_voyage;

        return $this;
    }
}
