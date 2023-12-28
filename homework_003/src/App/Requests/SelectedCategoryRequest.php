<?php

namespace App\Requests;

use App\Collections\CategoryCollection;
use App\Models\CategoryModel;

class SelectedCategoryRequest
{
    static function getSelectedCategory(CategoryCollection $collection): ?CategoryModel
    {
        $category = null;
        if (isset($_REQUEST['selectedCategory'])) {
            $category = $collection->searchCategoryByName($_REQUEST['selectedCategory']);
        }

        return $category;
    }
}