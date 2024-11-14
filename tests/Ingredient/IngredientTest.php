<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Ingredient;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase
{
    private Ingredient $testHozzavalo;

    protected function setUp(): void
    {
        $this->testHozzavalo = new Ingredient(
            name:     'Test ingredient',
            portion:  50,
            measure:  Measure::DB,
            category: 'Meat'
        );
    }

    #[Test]
    public function testWithMeasure(): void
    {
        $this->assertEquals(Measure::DB, $this->testHozzavalo->measure());

        $testHozzavalo = $this->testHozzavalo->withMeasure(Measure::KG);

        $this->assertEquals(50, $testHozzavalo->portion());
        $this->assertEquals(Measure::KG, $testHozzavalo->measure());
        $this->assertEquals('Meat', $testHozzavalo->category());
    }

    #[Test]
    public function testWithPortion(): void
    {
        $this->assertEquals(50, $this->testHozzavalo->portion());

        $testHozzavalo = $this->testHozzavalo->withPortion(20);

        $this->assertEquals(20, $testHozzavalo->portion());
        $this->assertEquals(Measure::DB, $testHozzavalo->measure());
        $this->assertEquals('Meat', $testHozzavalo->category());
    }

    #[Test]
    public function testWithCategory(): void
    {
        $this->assertEquals('Meat', $this->testHozzavalo->category());

        $testHozzavalo = $this->testHozzavalo->withCategory('Drinks');

        $this->assertEquals(50, $testHozzavalo->portion());
        $this->assertEquals(Measure::DB, $testHozzavalo->measure());
        $this->assertEquals('Drinks', $testHozzavalo->category());
    }
}
