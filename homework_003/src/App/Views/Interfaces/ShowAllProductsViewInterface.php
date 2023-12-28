<?php

namespace App\Views\Interfaces;

use App\Collections\ProductCollection;

interface ShowAllProductsViewInterface
{
    /**
     * Этот метод выводит на экран сразу
     * @param ProductCollection $collection
     * @return void
     */
    function echoAll(ProductCollection $collection) : void;

    /**
     * Этот метод строит html код - и возвращает его
     * @param ProductCollection $collection
     * @return string
     */
    function getAllHtml(ProductCollection $collection): string;
}