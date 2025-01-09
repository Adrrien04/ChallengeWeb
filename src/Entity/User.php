<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource]  // Cette annotation permet d'exposer l'entité via l'API
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]                                                       
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    // Implémentation de la méthode getRoles()
    public function getRoles(): array
    {
        // Les utilisateurs auront toujours un rôle par défaut "ROLE_USER"
        return ['ROLE_USER'];
    }

    public function getPassword(): string
    {
        return $this->mdp;
    }

    public function eraseCredentials()
    {
        // Si l'utilisateur a des données sensibles à effacer, les ajouter ici
    }
}