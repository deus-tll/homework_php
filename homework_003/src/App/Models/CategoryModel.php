<?php

namespace App\Models;

use App\Collections\ProductCollection;

class CategoryModel
{
    private string $name;
    private ProductCollection $productCollection;

    public function __construct(string $name, ProductCollection $productCollection)
    {
        $this->name = $name;
        $this->productCollection = $productCollection;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getCategoryProducts(): array
    {
        return $this->productCollection->getAll();
    }

    public function getName(): string
    {
        return $this->name;
    }
}