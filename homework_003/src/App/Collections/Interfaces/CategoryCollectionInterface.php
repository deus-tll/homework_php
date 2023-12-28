<?php

namespace App\Collections\Interfaces;

use App\Models\CategoryModel;

interface CategoryCollectionInterface
{
    function addCategory(CategoryModel $category): void;
    function searchCategoryByName(string $name): ?CategoryModel;
}