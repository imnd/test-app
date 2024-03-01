<?php

namespace App\Console\Commands;

use App\Models\Cow;
use App\Models\Hen;
use App\Services\Farm;
use Illuminate\Console\Command;

class Life extends Command
{
    protected $signature = 'farm:life';

    protected $description = 'Command description';

    private Farm $farm;

    public function __construct()
    {
        $this->farm = new Farm;

        parent::__construct();
    }

    public function handle()
    {
        // добавить животных в хлев (10 коров и 20 кур).
        $this->addAnimals([
            Cow::class => 10,
            Hen::class => 20,
        ]);

        // Вывести на экран информацию о количестве каждого типа животных на ферме.
        $this->showAnimals();

        // 7 раз (неделю) произвести сбор продукции (подоить коров и собрать яйца у кур).
        for ($i = 0; $i < 7; $i++) {
            $this->farm->generateProducts();
        }

        // Вывести на экран общее кол-во собранной за неделю продукции каждого типа.
        $this->showProducts();

        // Добавить на ферму ещё 5 кур и 1 корову (съездили на рынок, купили животных).
        $this->addAnimals([
            Cow::class => 1,
            Hen::class => 5,
        ]);

        // Снова вывести информацию о количестве каждого типа животных на ферме.
        $this->showAnimals();

        // Снова 7 раз (неделю) производим сбор продукции и выводим результат на экран.
        for ($i = 0; $i < 7; $i++) {
            $this->farm->generateProducts();
        }
        $this->showProducts();
    }

    /**
     * Добавить животных в хлев
     */
    private function addAnimals($animals): void
    {
        foreach ($animals as $className => $count) {
            for ($i = 0; $i < $count; $i++) {
                $this->farm->addAnimal(new $className($i));
            }
        }
    }

    /**
     * Вывести на экран информацию о количестве каждого типа животных на ферме.
     */
    private function showAnimals(): void
    {
        echo PHP_EOL, "Animals:", PHP_EOL;
        foreach ($this->farm->collectAnimals() as $animalName => $count) {
            echo "$animalName: $count", PHP_EOL;
        }
    }

    /**
     * Вывести на экран общее кол-во собранной за неделю продукции каждого типа.
     */
    private function showProducts(): void
    {
        echo PHP_EOL, "Products:", PHP_EOL;
        foreach ($this->farm->collectProducts() as $animalName => $count) {
            echo "$animalName: $count", PHP_EOL;
        }
    }
}
