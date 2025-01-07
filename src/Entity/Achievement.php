<?php

namespace App\Entity;

use App\Repository\AchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchievementRepository::class)]
class Achievement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'achievements')]
    private Collection $utilisateur;

    #[ORM\ManyToOne(inversedBy: 'achievements')]
    private ?Quest $quete = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAccomplissement = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    public function __construct()
    {
        $this->utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(User $utilisateur): static
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur->add($utilisateur);
        }

        return $this;
    }

    public function removeUtilisateur(User $utilisateur): static
    {
        $this->utilisateur->removeElement($utilisateur);

        return $this;
    }

    public function getQuete(): ?Quest
    {
        return $this->quete;
    }

    public function setQuete(?Quest $quete): static
    {
        $this->quete = $quete;

        return $this;
    }

    public function getDateAccomplissement(): ?\DateTimeInterface
    {
        return $this->dateAccomplissement;
    }

    public function setDateAccomplissement(\DateTimeInterface $dateAccomplissement): static
    {
        $this->dateAccomplissement = $dateAccomplissement;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }
}
