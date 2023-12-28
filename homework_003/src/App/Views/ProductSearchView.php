<?php

namespace App\Views;

use App\Collections\ProductCollection;
use App\Requests\ProductSearchRequest;

class ProductSearchView
{
    public function showResult(ProductCollection $collection): void
    {
        $str = ProductSearchRequest::getSearchString();
        if (strlen($str) < 2) {
            echo "Слишком мало символов для поиска";
            return;
        }

        $data = $collection->searchByName($str);

        if(sizeof($data) == 0){
            echo "По вашему запросу <strong>$str</strong> ничего не найдено";
            return;
        }
        echo "По вашему запросу <strong>$str</strong> найдено " . sizeof($data) . " продуктов ";
        echo "<ul>";
        foreach ($data as $product) {
            echo "<li> $product </li>";
        }
        echo "</ul>";
    }

}