<?php

namespace App\Forms;

use App\Forms\Interfaces\ModelFormInterface;

class ProductForm implements ModelFormInterface
{

    function getForm(): string
    {
        ob_start();
        $this->echoForm();
        return ob_get_clean();
    }

    function echoForm(): void
    {
        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "' >";
        echo "<input type='text' name='productName' />";
        echo "<input type='number' name='productPrice' />";
        echo "<input type='submit' value='Save' />";
        echo "</form>";
    }
}
