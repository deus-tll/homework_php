<?php

namespace Lib\Patterns;


class Registry
{
    /**
     * Место для хранения данных
     * @var array
     */
    protected $data = array();

    public function __get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function __set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function unset($key)
    {
        $this->unset($this->data[$key]);
        if (array_key_exists($key, $this->data)) {
            $this->unset($this->data[$key]);
        }
    }

    public function __toString(): string
    {
        $result = "\n [";
        foreach ($this->data as $element) {
            if ( (is_object($element) && method_exists($element, "__toString")) ||
                 !is_object($element) ) {
                $result .= "\t" . $element . ", \n";
            } else {
                $result .= "\t" . get_class($element) . ", \n";
            }
        }
        $result = "] \n";

        return $result;
    }


}
