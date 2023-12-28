<?php

namespace App\Views;

use App\Collections\CategoryCollection;
use App\Views\Interfaces\ShowAllCategoriesViewInterface;
use App\Views\Interfaces\ShowAllElementsViewInterface;

class CategoryView implements ShowAllElementsViewInterface
{
    function echoAll(array $array): void
    {
        echo "<ul>";
        foreach ($array as $category) {
            echo "<li><a href='?selectedCategory={$category->getName()}'>{$category->getName()}</a></li>";
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