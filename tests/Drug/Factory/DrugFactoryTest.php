<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\TestCase;

class DrugFactoryTest extends TestCase
{
    private DrugFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new DrugFactory(
            __DIR__ . '/../../../app/drugs.yaml',
            __DIR__ . '/../../../app/drugCategories.yaml',
        );
    }

    public function testCreateWithPortion(): void
    {
        $drug = $this->sut->createWithPortion('Mosószer', 4);

        $this->assertEquals('Mosószer', $drug->name());
        $this->assertEquals(new DrugCategory('Tisztítószer', 5, 1), $drug->category());
        $this->assertEquals(Measure::L, $drug->measurePreference());
        $this->assertEquals(4, $drug->portion());
        $this->assertNull($drug->measure());
    }

    public function testCreate(): void
    {
        $drug = $this->sut->create('Mosószer');

        $this->assertEquals('Mosószer', $drug->name());
        $this->assertEquals(new DrugCategory('Tisztítószer', 5, 1), $drug->category());
        $this->assertEquals(Measure::L, $drug->measurePreference());
    }
}
