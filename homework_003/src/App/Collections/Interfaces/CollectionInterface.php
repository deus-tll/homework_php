<?php

namespace App\Collections\Interfaces;

interface CollectionInterface
{
    function getAll() : array;

    function clearAll(): void;
}