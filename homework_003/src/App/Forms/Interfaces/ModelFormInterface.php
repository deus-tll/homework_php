<?php

namespace App\Forms\Interfaces;

interface ModelFormInterface
{
    function getForm() : string;
    function echoForm() : void;
}
