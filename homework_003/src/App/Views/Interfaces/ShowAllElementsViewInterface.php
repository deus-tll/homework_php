<?php

namespace App\Views\Interfaces;

interface ShowAllElementsViewInterface
{
    /**
     * Этот метод выводит на экран сразу
     * @param array $array
     * @return void
     */
    function echoAll(array $array) : void;

    /**
     * Этот метод строит html код - и возвращает его
     * @param array $array
     * @return string
     */
    function getAllHtml(array $array): string;
}