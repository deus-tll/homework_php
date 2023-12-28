<?php

namespace App\Requests;

use App\Collections\ProductCollection;
use App\Models\CategoryModel;

class CategoryCreateRequest
{
    /**
     * @return CategoryModel|null
     */
    static function getCategory(array $products): ?CategoryModel
    {
        if (isset($_REQUEST['categoryName'])){
            return new CategoryModel($_REQUEST['categoryName'], new ProductCollection($products));
        }

        return null;
    }
}