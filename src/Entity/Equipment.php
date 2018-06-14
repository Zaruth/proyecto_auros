<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentRepository")
 */
class Equipment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subtype;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $hands;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Stat", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $statid;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Item", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $itemid;

    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(string $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getHands(): ?int
    {
        return $this->hands;
    }

    public function setHands(int $hands): self
    {
        $this->hands = $hands;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getStat(): ?Stat
    {
        return $this->statid;
    }

    public function setStat(Stat $statid): self
    {
        $this->statid = $statid;

        return $this;
    }

    public function getItemid(): ?Item
    {
        return $this->itemid;
    }

    public function setItemid(Item $itemid): self
    {
        $this->itemid = $itemid;

        return $this;
    }
}
