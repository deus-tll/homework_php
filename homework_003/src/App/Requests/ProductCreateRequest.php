<?php

namespace App\Requests;

use App\Models\ProductModel;

class ProductCreateRequest
{

    /**
     * @return ProductModel|null
     */
    static function getProduct(): ?ProductModel
    {
        if(isset($_POST['productName']) && isset($_POST['productPrice'])) {
            return new ProductModel($_POST['productName'], $_POST['productPrice']);
        }
        return null;
    }
}
