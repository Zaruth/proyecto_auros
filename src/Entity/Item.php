<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $purchaselvl;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $foundlvl;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $uselvl;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $goldvalue;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $silvervalue;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $coppervalue;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $exp;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $uses;

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getPurchaselvl(): ?int
    {
        return $this->purchaselvl;
    }

    public function setPurchaselvl(int $purchaselvl): self
    {
        $this->purchaselvl = $purchaselvl;

        return $this;
    }

    public function getFoundlvl(): ?int
    {
        return $this->foundlvl;
    }

    public function setFoundlvl(int $foundlvl): self
    {
        $this->foundlvl = $foundlvl;

        return $this;
    }

    public function getUselvl(): ?int
    {
        return $this->uselvl;
    }

    public function setUselvl(int $uselvl): self
    {
        $this->uselvl = $uselvl;

        return $this;
    }

    public function getGoldvalue(): ?int
    {
        return $this->goldvalue;
    }

    public function setGoldvalue(int $goldvalue): self
    {
        $this->goldvalue = $goldvalue;

        return $this;
    }

    public function getSilvervalue(): ?int
    {
        return $this->silvervalue;
    }

    public function setSilvervalue(int $silvervalue): self
    {
        $this->silvervalue = $silvervalue;

        return $this;
    }

    public function getCoppervalue(): ?int
    {
        return $this->coppervalue;
    }

    public function setCoppervalue(int $coppervalue): self
    {
        $this->coppervalue = $coppervalue;

        return $this;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function setExp(int $exp): self
    {
        $this->exp = $exp;

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

    public function getUses(): ?int
    {
        return $this->uses;
    }

    public function setUses(int $uses): self
    {
        $this->uses = $uses;

        return $this;
    }
}
