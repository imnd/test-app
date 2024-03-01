<?php

namespace App\Models;

/**
 * Животина
 */
abstract class Animal
{
    /**
     * Уникальный регистрационный номер
     */
    protected string $number;
    /**
     * Количество продуктов животного за один день
     */
    protected int $products = 0;

    /**
     * Ключ массива коллекции животных
     */
    protected string $collectionKeyName;
    /**
     * Название продукта
     */
    protected string $productName;

    public function __construct()
    {
        $this->number = uuid_create();
    }

    public function addToCollection(&$collection): void
    {
        $collection[$this->collectionKeyName] ??= 0;
        $collection[$this->collectionKeyName]++;
    }

    public function collectProducts(&$products): void
    {
        $products[$this->productName] ??= 0;
        $products[$this->productName] += $this->products;
    }

    public abstract function generateProducts(): void;
}
