<?php

namespace App\Models;

/**
 * По практической работе 13
 * @package App\Models
 */
class ProductModel
{
    private string $name;
    private float $price;

    /**
     * @param string $name
     * @param float $price
     */
    public function __construct(string $name, float $price) {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "(Name $this->name; price $this->price )";
    }

    /**
     * @return array
     */
    public function __serialize(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price
        ];
    }


    public function __unserialize(array $data): void
    {
        $this->name = $data['name']?? null;
        $this->price = $data['price']?? null;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
