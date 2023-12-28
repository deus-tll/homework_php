<?php

namespace App\Collections\Traits;

trait CollectionTrait
{
    private array $data = [];

    public function getAll(): array
    {
        return $this->data;
    }

    public function clearAll(): void
    {
        $this->data = [];
    }
}