<?php

namespace App\Views;

use App\Views\Interfaces\ShowAllElementsViewInterface;

class ProductView implements ShowAllElementsViewInterface
{
    function echoAll(array $array): void
    {
        echo "<ul>";
        foreach ($array as $product) {
            echo "<li> $product </li>";
        }
        echo "</ul>";
    }

    function getAllHtml(array $array): string
    {
        ob_start();
        $this->echoAll($array);
        return ob_get_clean();
    }
}