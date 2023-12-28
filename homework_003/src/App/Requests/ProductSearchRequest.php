<?php

namespace App\Requests;

class ProductSearchRequest
{
    static function getSearchString()
    {
        return $_REQUEST['search'] ?? null;
    }

}
