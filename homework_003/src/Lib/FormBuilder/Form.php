<?php

namespace Lib\FormBuilder;

use Lib\FormBuilder\Inputs\Input;

class Form
{
    public function __construct(
        public FormMethodsEnum $method = FormMethodsEnum::POST,
        public string|null $action = null
    )
    {
        if (!$this->action)
            $this->action =  $_SERVER['PHP_SELF'];
    }

    private $inputs = [];

    public function add(Input $input) : Form
    {
        $this->inputs[] = $input;
        return $this;
    }

    public function __toString(): string
    {
        $result = "<form  enctype='multipart/form-data' method='";

        $result.= $this->method->value;

//        if($this->method == FormMethodsEnum::GET)
//            $result.= 'GET';
//        else
//            $result.= 'POST';

        $result.= "' action='$this->action' >\n";
        foreach ($this->inputs as $input) {
            if ($input instanceof Input) {
                $result.= $input;
            }
        }
        $result.= "</form>\n";

        return $result;
    }

}
