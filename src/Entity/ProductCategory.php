<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\ProductCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ProductCategoryRepository::class)]
class ProductCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: ProductCard::class, cascade: ['persist', 'remove'])]
    private Collection $productCards;

    public function __construct()
    {
        $this->productCards = new ArrayCollection();
    }

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

    public function getProductCards(): Collection
    {
        return $this->productCards;
    }

    public function addProductCard(ProductCard $productCard): static
    {
        if (!$this->productCards->contains($productCard)) {
            $this->productCards[] = $productCard;
            $productCard->setCategory($this);
        }

        return $this;
    }

    public function removeProductCard(ProductCard $productCard): static
    {
        if ($this->productCards->removeElement($productCard)) {
            // Убираем связь на стороне ProductCard
            if ($productCard->getCategory() === $this) {
                $productCard->setCategory(null);
            }
        }

        return $this;
    }
}
