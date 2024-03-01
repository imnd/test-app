<?php

namespace App\Models;

/**
 * Курица
 */
class Hen extends Animal
{
    protected string $collectionKeyName = 'hens';
    protected string $productName = 'eggs';

    public function generateProducts(): void
    {
        $this->products = rand(0, 2);
    }
}
