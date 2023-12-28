<?php

namespace App\Collections;


use App\Collections\Interfaces\CategoryCollectionInterface;
use App\Collections\Interfaces\CollectionInterface;
use App\Collections\Traits\CollectionTrait;
use App\Models\CategoryModel;

class CategoryCollection implements CollectionInterface, CategoryCollectionInterface
{
    use CollectionTrait;

    function addCategory(CategoryModel $category): void
    {
        $this->data[] = $category;
    }

    function searchCategoryByName(string $name): ?CategoryModel
    {
        foreach ($this->data as $category) {
            if ($category->getName() === $name) {
                return $category;
            }
        }

        return null;
    }
}