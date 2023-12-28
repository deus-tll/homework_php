<?php

namespace App\Views;

use App\Views\Interfaces\ShowAllElementsViewInterface;

class ProductsByCategoryView implements ShowAllElementsViewInterface
{

    function echoAll(array $array): void
    {
        foreach ($array as $product) {
            echo "<p>{$product}</p>";
        }
    }

    function getAllHtml(array $array): string
    {
        ob_start();
        $this->echoAll($array);
        return ob_get_clean();
    }
}