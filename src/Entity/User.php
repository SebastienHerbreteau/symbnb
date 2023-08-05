<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity (
 *     fields={"email"},
 *     message="Cet email est déjà utilisé, merci de le modifier"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Merci de renseigner votre prénom"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Merci de renseigner votre nom"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message="Veuillez renseigner un email valide"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(
     *     message="Merci de renseigner une URL valide"
     * )
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     * @var @Assert\EqualTo(propertyPath="hash", message="Les mot de passe ne correspondent pas")
     */
    public $passwordConfirm;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min=10,
     *     minMessage="Votre introduction doit faire au moins 10 caractères"
     * )
     */
    private $introduction;

    /**
     * @ORM\Column(type="text")
     *  @Assert\Length(
     *     min=100,
     *     minMessage="Votre description doit faire au moins 100 caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * Permet d'initialiser le slug
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function initialiazeSlug()
    {

        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->firstName. ' ' . $this->lastName);

        }
    }
    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="author")
     */
    private $ads;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, mappedBy="users")
     */
    private $userRole;

    public function getFullName(){
        return "{$this->firstName} {$this->lastName}";
}
    public function __construct()
    {
        $this->ads = new ArrayCollection();
        $this->userRole = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Ad>
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setAuthor($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getAuthor() === $this) {
                $ad->setAuthor(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): ?string
    {
        return $this->getHash();
    }

    public function getSalt()
    {

    }

    public function getUsername(): ?string
    {
       return $this->getEmail();
    }

    public function eraseCredentials()
    {

    }

    /**
     * @return Collection<int, Role>
     */
    public function getUserRole(): Collection
    {
        return $this->userRole;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRole->contains($userRole)) {
            $this->userRole[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRole->removeElement($userRole)) {
            $userRole->removeUser($this);
        }

        return $this;
    }
}
