<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Entidad Usuario
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $role;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ipCreation;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $ipLogin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $premium;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $silenced;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $banned;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Character", cascade={"persist", "remove"})
     */
    private $u_character;

    public function __construct()
    {
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function getRoles()
    {
        return array($this->role);
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function getIpCreation(): ?string
    {
        return $this->ipCreation;
    }

    public function getIpLogin(): ?string
    {
        return $this->ipLogin;
    }

    public function getPremium(): ?\DateTimeInterface
    {
        return $this->premium;
    }

    public function getSilenced(): ?\DateTimeInterface
    {
        return $this->silenced;
    }

    public function getBanned(): ?\DateTimeInterface
    {
        return $this->banned;
    }



    // SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setIsActive($isActive)
    {
         $this->isActive = $isActive;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function setIpCreation(?string $ipCreation): self
    {
        $this->ipCreation = $ipCreation;

        return $this;
    }

    public function setIpLogin(?string $ipLogin): self
    {
        $this->ipLogin = $ipLogin;

        return $this;
    }

    public function setPremium(?\DateTimeInterface $premium): self
    {
        $this->premium = $premium;

        return $this;
    }

    public function setSilenced(?\DateTimeInterface $silenced): self
    {
        $this->silenced = $silenced;

        return $this;
    }

    public function setBanned(?\DateTimeInterface $banned): self
    {
        $this->banned = $banned;

        return $this;
    }



//////////////////////////////////////////////////////////////////
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getUCharacter(): ?Character
    {
        return $this->u_character;
    }

    public function setUCharacter(?Character $u_character): self
    {
        $this->u_character = $u_character;

        return $this;
    }
}