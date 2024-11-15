<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Ingredient;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
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

        $testHozzavalo = $this->testIngredient->withMeasure(Measure::KG);

        $this->assertEquals(50, $testHozzavalo->portion());
        $this->assertEquals(Measure::KG, $testHozzavalo->measure());
        $this->assertEquals('Meat', $testHozzavalo->category());
    }

    #[Test]
    public function testWithPortion(): void
    {
        $this->assertEquals(50, $this->testIngredient->portion());

        $testHozzavalo = $this->testIngredient->withPortion(20);

        $this->assertEquals(20, $testHozzavalo->portion());
        $this->assertEquals(Measure::DB, $testHozzavalo->measure());
        $this->assertEquals('Meat', $testHozzavalo->category());
    }

    #[Test]
    public function testWithCategory(): void
    {
        $this->assertEquals('Meat', $this->testIngredient->category());

        $testHozzavalo = $this->testIngredient->withCategory('Drinks');

        $this->assertEquals(50, $testHozzavalo->portion());
        $this->assertEquals(Measure::DB, $testHozzavalo->measure());
        $this->assertEquals('Drinks', $testHozzavalo->category());
    }
}
