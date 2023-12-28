<?php

namespace Lib\FormBuilder\Inputs;

class Input
{

    public function __construct(
        public string $type,
        public string $name,
        public $value = null,
        public $label = null,
        public $id = null,
        public $placeHolder = null )
    {
    }

    public function __toString(): string
    {
        $result = "<input type='$this->type' name='$this->name' ";
        if ($this->id)
            $result .= "id='$this->id' ";
        if ($this->value)
            $result .= "value='$this->value' ";
        if ($this->placeHolder)
            $result .= "placeholder='$this->placeHolder' ";
        $result .= " />";

        if ($this->label)
            $result = "<label>" . $this->label . $result . "</label>";

        return $result . "\n";
    }
}
