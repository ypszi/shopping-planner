<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Unit\Ingredient;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IngredientForFoodTest extends TestCase
{
    private Ingredient $testIngredient;

    protected function setUp(): void
    {
        $this->testIngredient = new IngredientForFood(
            name:     'Test ingredient',
            category: 'Meat',
            portion:  50,
            measure:  Measure::DB
        );
    }

    #[Test]
    public function testWithMeasure(): void
    {
        $this->assertEquals(Measure::DB, $this->testIngredient->measure());

        $testIngredient = $this->testIngredient->withMeasure(Measure::KG);

        $this->assertEquals(50, $testIngredient->portion());
        $this->assertEquals(Measure::KG, $testIngredient->measure());
        $this->assertEquals('Meat', $testIngredient->category());
    }

    #[Test]
    public function testWithPortion(): void
    {
        $this->assertEquals(50, $this->testIngredient->portion());

        $testIngredient = $this->testIngredient->withPortion(20);

        $this->assertEquals(20, $testIngredient->portion());
        $this->assertEquals(Measure::DB, $testIngredient->measure());
        $this->assertEquals('Meat', $testIngredient->category());
    }

    #[Test]
    public function testWithCategory(): void
    {
        $this->assertEquals('Meat', $this->testIngredient->category());

        $testIngredient = $this->testIngredient->withCategory('Drinks');

        $this->assertEquals(50, $testIngredient->portion());
        $this->assertEquals(Measure::DB, $testIngredient->measure());
        $this->assertEquals('Drinks', $testIngredient->category());
    }

    #[Test]
    #[DataProvider('portionDataProvider')]
    public function testToString(float $portion, string $expected): void
    {
        $testIngredient = new IngredientForFood(
            name:     'Test ingredient',
            category: 'Meat',
            portion:  $portion,
            measure:  Measure::DB
        );

        $this->assertSame($expected . ' db Test ingredient', $testIngredient->__toString());
    }

    public static function portionDataProvider(): array
    {
        return [
            '50'    => [50, '50'],
            '50.5'  => [50.5, '50.5'],
            '50.50' => [50.50, '50.5'],
            '50.55' => [50.55, '50.55'],
            '50.56' => [50.555, '50.56'],
            '50.506' => [50.505, '50.51'],
        ];
    }
}
