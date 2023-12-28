<?php

namespace App\Collections\Interfaces;

use App\Models\ProductModel;

interface ProductCollectionInterface
{
    function addProduct(ProductModel $product) : void;

    function searchByName(string $name) : array;
}