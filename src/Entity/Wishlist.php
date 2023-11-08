<?php

namespace App\Entity;

use App\Repository\WishlistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WishlistRepository::class)]
class Wishlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $listTitle = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $listDescription = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $lastEditAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListTitle(): ?string
    {
        return $this->listTitle;
    }

    public function setListTitle(string $listTitle): static
    {
        $this->listTitle = $listTitle;

        return $this;
    }

    public function getListDescription(): ?string
    {
        return $this->listDescription;
    }

    public function setListDescription(?string $listDescription): static
    {
        $this->listDescription = $listDescription;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLastEditAt(): ?\DateTimeImmutable
    {
        return $this->lastEditAt;
    }

    public function setLastEditAt(\DateTimeImmutable $lastEditAt): static
    {
        $this->lastEditAt = $lastEditAt;

        return $this;
    }
}
