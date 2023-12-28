<?php

namespace App\Views\Interfaces;

use App\Collections\CategoryCollection;

interface ShowAllCategoriesViewInterface
{
    /**
     * Этот метод выводит на экран сразу
     * @param CategoryCollection $collection
     * @return void
     */
    function echoAll(CategoryCollection $collection) : void;

    /**
     * Этот метод строит html код - и возвращает его
     * @param CategoryCollection $collection
     * @return string
     */
    function getAllHtml(CategoryCollection $collection): string;
}