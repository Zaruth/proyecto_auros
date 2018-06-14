<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatRepository")
 */
class Stat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $ability;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $hp;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $ad;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $md;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $armor;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $magicdef;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $critic;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $inte;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $manna;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $spirit;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $agility;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $fury;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $firedmg;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $fireres;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $waterdmg;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $waterres;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $earthdmg;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $earthres;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $airdmg;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $airres;

    public function getId()
    {
        return $this->id;
    }

    public function getAbility(): ?int
    {
        return $this->ability;
    }

    public function setAbility(int $ability): self
    {
        $this->ability = $ability;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): self
    {
        $this->hp = $hp;

        return $this;
    }

    public function getAd(): ?int
    {
        return $this->ad;
    }

    public function setAd(int $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    public function getMd(): ?int
    {
        return $this->md;
    }

    public function setMd(int $md): self
    {
        $this->md = $md;

        return $this;
    }

    public function getArmor(): ?int
    {
        return $this->armor;
    }

    public function setArmor(int $armor): self
    {
        $this->armor = $armor;

        return $this;
    }

    public function getMagicdef(): ?int
    {
        return $this->magicdef;
    }

    public function setMagicdef(int $magicdef): self
    {
        $this->magicdef = $magicdef;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getCritic(): ?int
    {
        return $this->critic;
    }

    public function setCritic(int $critic): self
    {
        $this->critic = $critic;

        return $this;
    }

    public function getInte(): ?int
    {
        return $this->inte;
    }

    public function setInte(int $inte): self
    {
        $this->inte = $inte;

        return $this;
    }

    public function getManna(): ?int
    {
        return $this->manna;
    }

    public function setManna(int $manna): self
    {
        $this->manna = $manna;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getSpirit(): ?int
    {
        return $this->spirit;
    }

    public function setSpirit(int $spirit): self
    {
        $this->spirit = $spirit;

        return $this;
    }

    public function getAgility(): ?int
    {
        return $this->agility;
    }

    public function setAgility(int $agility): self
    {
        $this->agility = $agility;

        return $this;
    }

    public function getFury(): ?int
    {
        return $this->fury;
    }

    public function setFury(int $fury): self
    {
        $this->fury = $fury;

        return $this;
    }

    public function getFiredmg(): ?int
    {
        return $this->firedmg;
    }

    public function setFiredmg(int $firedmg): self
    {
        $this->firedmg = $firedmg;

        return $this;
    }

    public function getFireres(): ?int
    {
        return $this->fireres;
    }

    public function setFireres(int $fireres): self
    {
        $this->fireres = $fireres;

        return $this;
    }

    public function getWaterdmg(): ?int
    {
        return $this->waterdmg;
    }

    public function setWaterdmg(int $waterdmg): self
    {
        $this->waterdmg = $waterdmg;

        return $this;
    }

    public function getWaterres(): ?int
    {
        return $this->waterres;
    }

    public function setWaterres(int $waterres): self
    {
        $this->waterres = $waterres;

        return $this;
    }

    public function getEarthdmg(): ?int
    {
        return $this->earthdmg;
    }

    public function setEarthdmg(int $earthdmg): self
    {
        $this->earthdmg = $earthdmg;

        return $this;
    }

    public function getEarthres(): ?int
    {
        return $this->earthres;
    }

    public function setEarthres(int $earthres): self
    {
        $this->earthres = $earthres;

        return $this;
    }

    public function getAirdmg(): ?int
    {
        return $this->airdmg;
    }

    public function setAirdmg(int $airdmg): self
    {
        $this->airdmg = $airdmg;

        return $this;
    }

    public function getAirres(): ?int
    {
        return $this->airres;
    }

    public function setAirres(int $airres): self
    {
        $this->airres = $airres;

        return $this;
    }
}
