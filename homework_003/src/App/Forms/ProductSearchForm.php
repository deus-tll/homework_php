<?php

namespace App\Forms;

use App\Requests\ProductSearchRequest;

class ProductSearchForm
{

    public function echoForm(): void
    {
        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "' >";
        echo "<input type='text' name='search' value='" . ProductSearchRequest::getSearchString() . "'/>";
        echo "<input type='submit' value='Search' name='doSearch' />";
        echo "</form>";

    }

}
