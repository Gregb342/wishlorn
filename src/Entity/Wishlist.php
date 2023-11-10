<?php

namespace App\Entity;

use App\Repository\WishlistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'wishlists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $WishlistOwner = null;

    #[ORM\OneToMany(mappedBy: 'wishlist', targetEntity: WishlistItem::class, orphanRemoval: true)]
    private Collection $wishlistItems;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->wishlistItems = new ArrayCollection();
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

    public function getWishlistOwner(): ?User
    {
        return $this->WishlistOwner;
    }

    public function setWishlistOwner(?User $WishlistOwner): static
    {
        $this->WishlistOwner = $WishlistOwner;

        return $this;
    }

    /**
     * @return Collection<int, WishlistItem>
     */
    public function getWishlistItems(): Collection
    {
        return $this->wishlistItems;
    }

    public function addWishlistItem(WishlistItem $wishlistItem): static
    {
        if (!$this->wishlistItems->contains($wishlistItem)) {
            $this->wishlistItems->add($wishlistItem);
            $wishlistItem->setWishlist($this);
        }

        return $this;
    }

    public function removeWishlistItem(WishlistItem $wishlistItem): static
    {
        if ($this->wishlistItems->removeElement($wishlistItem)) {
            // set the owning side to null (unless already changed)
            if ($wishlistItem->getWishlist() === $this) {
                $wishlistItem->setWishlist(null);
            }
        }

        return $this;
    }
}
