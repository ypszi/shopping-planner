<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Ingredient\Factory;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
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
            foodName  : 'food',
            ingredient: [
                'name'    => 'Bors',
                'portion' => '4 dkg',
            ]
        );

        $this->assertEquals('Fekete bors', $ingredient->name());
        $this->assertEquals(4, $ingredient->portion());
        $this->assertEquals('Fűszer', $ingredient->category());
        $this->assertEquals(Measure::DKG, $ingredient->measure());
        $this->assertEquals(Measure::G, $ingredient->measurePreference());
        $this->assertEquals('4 dkg Fekete bors', (string)$ingredient);
    }

    #[Test]
    public function testForFoodWithRefernce(): void
    {
        $ingredient = $this->sut->forFood(
            foodName  : 'food',
            ingredient: [
                'name'    => 'Étolaj',
                'portion' => '1 dl',
            ]
        );

        $this->assertEquals('Napraforgóolaj', $ingredient->name());
        $this->assertEquals(1, $ingredient->portion());
        $this->assertEquals('Olaj', $ingredient->category());
        $this->assertEquals(Measure::DL, $ingredient->measure());
        $this->assertEquals(Measure::L, $ingredient->measurePreference());
        $this->assertEquals('1 dl Napraforgóolaj', (string)$ingredient);

        $this->assertEquals('Étolaj', $ingredient->reference()?->name());
        $this->assertEquals('Olaj', $ingredient->reference()?->category());
        $this->assertEquals(Measure::L, $ingredient->reference()?->measurePreference());
        $this->assertEquals('Étolaj', (string)$ingredient->reference());
    }
}
