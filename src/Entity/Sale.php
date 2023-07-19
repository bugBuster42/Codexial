<?php

namespace App\Entity;

use App\Repository\SaleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaleRepository::class)]
class Sale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $saleDate = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $seller = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 2, scale: 2)]
    private ?string $revenue = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoBefore = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photoAfter = null;

    #[ORM\Column(length: 255)]
    private ?string $listing = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Store $store = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaleDate(): ?\DateTimeInterface
    {
        return $this->saleDate;
    }

    public function setSaleDate(\DateTimeInterface $saleDate): static
    {
        $this->saleDate = $saleDate;

        return $this;
    }

    public function getSeller(): ?User
    {
        return $this->seller;
    }

    public function setSeller(?User $seller): static
    {
        $this->seller = $seller;

        return $this;
    }

    public function getRevenue(): ?string
    {
        return $this->revenue;
    }

    public function setRevenue(string $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPhotoBefore(): ?string
    {
        return $this->photoBefore;
    }

    public function setPhotoBefore(?string $photoBefore): static
    {
        $this->photoBefore = $photoBefore;

        return $this;
    }

    public function getPhotoAfter(): ?string
    {
        return $this->photoAfter;
    }

    public function setPhotoAfter(?string $photoAfter): static
    {
        $this->photoAfter = $photoAfter;

        return $this;
    }

    public function getListing(): ?string
    {
        return $this->listing;
    }

    public function setListing(string $listing): static
    {
        $this->listing = $listing;

        return $this;
    }

    public function getStore(): ?store
    {
        return $this->store;
    }

    public function setStore(?store $store): static
    {
        $this->store = $store;

        return $this;
    }
}
