<?php

declare(strict_types=1);

namespace Ingredient\Factory;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IngredientFactoryTest extends TestCase
{
    private IngredientFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new IngredientFactory(
            __DIR__ . '/../../../app/ingredients.yaml',
            __DIR__ . '/../../../app/ingredientCategories.yaml',
        );
    }

    #[Test]
    public function testForFood(): void
    {
        $ingredient = $this->sut->forFood(
            foodName:   'food',
            ingredient: [
                            'name'      => 'Bors',
                            'mennyiseg' => '4 dkg',
                        ]
        );

        $this->assertEquals('Bors', $ingredient->name());
        $this->assertEquals(4, $ingredient->portion());
        $this->assertEquals('Fűszer', $ingredient->category());
        $this->assertEquals(Measure::DKG, $ingredient->measure());
        $this->assertEquals(Measure::G, $ingredient->measurePreference());
        $this->assertEquals('4.00 dkg Bors', (string)$ingredient);
    }

    #[Test]
    public function testForFoodWithRefernce(): void
    {
        $ingredient = $this->sut->forFood(
            foodName:   'food',
            ingredient: [
                            'name'      => 'Étolaj',
                            'mennyiseg' => '1 dl',
                        ]
        );

        $this->assertEquals('Napraforgó olaj', $ingredient->name());
        $this->assertEquals(1, $ingredient->portion());
        $this->assertEquals('Olaj', $ingredient->category());
        $this->assertEquals(Measure::DL, $ingredient->measure());
        $this->assertEquals(Measure::L, $ingredient->measurePreference());
        $this->assertEquals('1.00 dl Napraforgó olaj', (string)$ingredient);
    }
}