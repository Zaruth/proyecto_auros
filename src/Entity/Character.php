<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="characters")
 * @ORM\Entity(repositoryClass="App\Repository\CharacterRepository")
 */
class Character
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
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $surName2;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $race;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $age;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $class;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $subclass;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $exp;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $energy;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $skillpoints;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $gold;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $silver;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $copper;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $worked;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $workStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $workFinish;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $fights;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $fightsWon;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastFight;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastForum;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastMsg;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bot;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="characterfrom")
     */
    private $charmessages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="cpost")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Thread", mappedBy="cthread")
     */
    private $threads;

    public function __construct()
    {
        $this->charmessages = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->threads = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSurName(): ?string
    {
        return $this->surName;
    }

    public function setSurName(string $surName): self
    {
        $this->surName = $surName;

        return $this;
    }

    public function getSurName2(): ?string
    {
        return $this->surName2;
    }

    public function setSurName2(?string $surName2): self
    {
        $this->surName2 = $surName2;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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

    public function getSubclass(): ?string
    {
        return $this->subclass;
    }

    public function setSubclass(string $subclass): self
    {
        $this->subclass = $subclass;

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

    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    public function setEnergy(int $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    public function getSkillpoints(): ?int
    {
        return $this->skillpoints;
    }

    public function setSkillpoints(int $skillpoints): self
    {
        $this->skillpoints = $skillpoints;

        return $this;
    }

    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): self
    {
        $this->gold = $gold;

        return $this;
    }

    public function getSilver(): ?int
    {
        return $this->silver;
    }

    public function setSilver(int $silver): self
    {
        $this->silver = $silver;

        return $this;
    }

    public function getCopper(): ?int
    {
        return $this->copper;
    }

    public function setCopper(int $copper): self
    {
        $this->copper = $copper;

        return $this;
    }

    public function getWorked(): ?int
    {
        return $this->worked;
    }

    public function setWorked(int $worked): self
    {
        $this->worked = $worked;

        return $this;
    }

    public function getWorkStart(): ?\DateTimeInterface
    {
        return $this->workStart;
    }

    public function setWorkStart(\DateTimeInterface $workStart = null): self
    {
        $this->workStart = $workStart;

        return $this;
    }

    public function getWorkFinish(): ?\DateTimeInterface
    {
        return $this->workFinish;
    }

    public function setWorkFinish(\DateTimeInterface $workFinish = null): self
    {
        $this->workFinish = $workFinish;

        return $this;
    }

    public function getFights(): ?int
    {
        return $this->fights;
    }

    public function setFights(int $fights): self
    {
        $this->fights = $fights;

        return $this;
    }

    public function getFightsWon(): ?int
    {
        return $this->fightsWon;
    }

    public function setFightsWon(int $fightsWon): self
    {
        $this->fightsWon = $fightsWon;

        return $this;
    }

    public function getLastFight(): ?\DateTimeInterface
    {
        return $this->lastFight;
    }

    public function setLastFight(\DateTimeInterface $lastFight): self
    {
        $this->lastFight = $lastFight;

        return $this;
    }

    public function getLastForum(): ?\DateTimeInterface
    {
        return $this->lastForum;
    }

    public function setLastForum(\DateTimeInterface $lastForum): self
    {
        $this->lastForum = $lastForum;

        return $this;
    }

    public function getLastMsg(): ?\DateTimeInterface
    {
        return $this->lastMsg;
    }

    public function setLastMsg(\DateTimeInterface $lastMsg): self
    {
        $this->lastMsg = $lastMsg;

        return $this;
    }

    public function getBot(): ?bool
    {
        return $this->bot;
    }

    public function setBot(bool $bot): self
    {
        $this->bot = $bot;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getCharmessages(): Collection
    {
        return $this->charmessages;
    }

    public function addCharmessage(Message $charmessage): self
    {
        if (!$this->charmessages->contains($charmessage)) {
            $this->charmessages[] = $charmessage;
            $charmessage->setPlayerfrom($this);
        }

        return $this;
    }

    public function removeCharmessage(Message $charmessage): self
    {
        if ($this->charmessages->contains($charmessage)) {
            $this->charmessages->removeElement($charmessage);
            // set the owning side to null (unless already changed)
            if ($charmessage->getPlayerfrom() === $this) {
                $charmessage->setPlayerfrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setCpost($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getCpost() === $this) {
                $post->setCpost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Thread[]
     */
    public function getThreads(): Collection
    {
        return $this->threads;
    }

    public function addThread(Thread $thread): self
    {
        if (!$this->threads->contains($thread)) {
            $this->threads[] = $thread;
            $thread->setCthread($this);
        }

        return $this;
    }

    public function removeThread(Thread $thread): self
    {
        if ($this->threads->contains($thread)) {
            $this->threads->removeElement($thread);
            // set the owning side to null (unless already changed)
            if ($thread->getCthread() === $this) {
                $thread->setCthread(null);
            }
        }

        return $this;
    }
}
