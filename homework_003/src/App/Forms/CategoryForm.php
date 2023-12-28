<?php

namespace App\Forms;

use App\Forms\Interfaces\ModelFormInterface;

class CategoryForm implements ModelFormInterface
{
    function echoForm(): void
    {
        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "' >";
        echo "<input type='text' name='categoryName' />";
        echo "<input type='submit' value='Add Category'/>";
        echo "</form>";
    }

    function getForm(): string
    {
        ob_start();
        $this->echoForm();
        return ob_get_clean();
    }
}