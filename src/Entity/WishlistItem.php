<?php

namespace App\Entity;

use App\Repository\WishlistItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WishlistItemRepository::class)]
class WishlistItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $itemName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $itemDescription = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $itemPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $itemUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $itemPicture = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?bool $isPurchased = null;

    #[ORM\ManyToOne(inversedBy: 'wishlistItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Wishlist $wishlist = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->isActive = true;
        $this->isPurchased = false; 
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(string $itemName): static
    {
        $this->itemName = $itemName;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    public function setItemDescription(?string $itemDescription): static
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    public function getItemPrice(): ?string
    {
        return $this->itemPrice;
    }

    public function setItemPrice(?string $itemPrice): static
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }

    public function getItemUrl(): ?string
    {
        return $this->itemUrl;
    }

    public function setItemUrl(?string $itemUrl): static
    {
        $this->itemUrl = $itemUrl;

        return $this;
    }

    public function getItemPicture(): ?string
    {
        return $this->itemPicture;
    }

    public function setItemPicture(?string $itemPicture): static
    {
        $this->itemPicture = $itemPicture;

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

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function isIsPurchased(): ?bool
    {
        return $this->isPurchased;
    }

    public function setIsPurchased(bool $isPurchased): static
    {
        $this->isPurchased = $isPurchased;

        return $this;
    }

    public function getWishlist(): ?Wishlist
    {
        return $this->wishlist;
    }

    public function setWishlist(?Wishlist $wishlist): static
    {
        $this->wishlist = $wishlist;

        return $this;
    }
}
