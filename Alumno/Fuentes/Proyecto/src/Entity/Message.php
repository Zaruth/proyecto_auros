<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad mensaje
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterfrom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Character", inversedBy="charmessages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $characterto;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reported;

    public function getId()
    {
        return $this->id;
    }

    public function getCharacterfrom(): ?Character
    {
        return $this->characterfrom;
    }

    public function setCharacterfrom(?Character $characterfrom): self
    {
        $this->characterfrom = $characterfrom;

        return $this;
    }

    public function getCharacterto(): ?Character
    {
        return $this->characterto;
    }

    public function setCharacterto(?Character $characterto): self
    {
        $this->characterto = $characterto;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReported(): ?bool
    {
        return $this->reported;
    }

    public function setReported(bool $reported): self
    {
        $this->reported = $reported;

        return $this;
    }
}
