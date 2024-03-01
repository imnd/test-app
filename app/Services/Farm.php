<?php

namespace App\Services;

use App\Models\Animal;

class Farm
{
    /** @var Animal[] */
    protected array $animals;

    /**
     * Добавлять животных в хлев поштучно
     */
    public function addAnimal(Animal $animal): void
    {
        $this->animals[] = $animal;
    }

    /**
     * Посчитать всех животных, зарегистрированных в хлеву
     */
    public function collectAnimals(): array
    {
        $collection = [];

        foreach ($this->animals as $animal) {
            $animal->addToCollection($collection);
        }

        return $collection;
    }

    /**
     * Собирать продукцию у всех животных, зарегистрированных в хлеву
     */
    public function generateProducts(): void
    {
        foreach ($this->animals as $animal) {
            $animal->generateProducts();
        }
    }

    /**
     * Подсчитывать общее кол-во собранной продукции
     */
    public function collectProducts(): array
    {
        $products = [];

        foreach ($this->animals as $animal) {
            $animal->collectProducts($products);
        }

        return $products;
    }
}
