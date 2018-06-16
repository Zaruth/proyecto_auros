<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HaveItemsRepository")
 */
class HaveItems
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inuse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="haveItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $charac;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipment")
     * @ORM\JoinColumn(nullable=false)
     */
    private $iequipment;

    public function getId()
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getInuse(): ?bool
    {
        return $this->inuse;
    }

    public function setInuse(bool $inuse): self
    {
        $this->inuse = $inuse;

        return $this;
    }

    public function getCharac(): ?Character
    {
        return $this->charac;
    }

    public function setCharac(?Character $charac): self
    {
        $this->charac = $charac;

        return $this;
    }

    public function getIequipment(): ?Equipment
    {
        return $this->iequipment;
    }

    public function setIequipment(?Equipment $iequipment): self
    {
        $this->iequipment = $iequipment;

        return $this;
    }
}
