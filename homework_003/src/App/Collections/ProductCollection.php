<?php

namespace App\Collections;

use App\Collections\Interfaces\CollectionInterface;
use App\Collections\Interfaces\ProductCollectionInterface;
use App\Collections\Interfaces\SeedInterface;
use App\Collections\Traits\CollectionTrait;
use App\Models\ProductModel;

class ProductCollection implements CollectionInterface, ProductCollectionInterface, SeedInterface
{
    use CollectionTrait;

    public function __construct(array $initialData = [])
    {
        if (empty($initialData)) {
            $this->seed();
        } else {
            $this->addProducts($initialData);
        }
    }

    function addProduct(ProductModel $product): void
    {
        $this->data[] = $product;
    }

    public function addProducts(array $products): void
    {
        foreach ($products as $product) {
            if ($product instanceof ProductModel) {
                $this->addProduct($product);
            }
        }
    }

    function searchByName(string $name): array
    {

        $foundProducts = [];

        foreach ($this->data as $product) {
            if ($product instanceof ProductModel && $product->getName() === $name) {
                $foundProducts[] = $product;
            }
        }

        return $foundProducts;
    }

    function seed(): void
    {
        $this->data[] = new ProductModel('EcoFlow Delta 2', 59000);
        $this->data[] = new ProductModel('Samsung S23', 39000);
        $this->data[] = new ProductModel('Nokia 3033', 100);
    }
}