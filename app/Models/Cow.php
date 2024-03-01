<?php

namespace App\Models;

/**
 * Корова
 */
class Cow extends Animal
{
    protected string $collectionKeyName = 'cows';
    protected string $productName = 'milk';

    public function generateProducts(): void
    {
        $this->products = rand(8, 12);
    }
}
