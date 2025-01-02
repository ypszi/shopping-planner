<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PHPUnit\Framework\TestCase;

class DrugsFactoryTest extends TestCase
{
    private DrugsFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new DrugsFactory(
            new DrugFactory(
                __DIR__ . '/../../../app/drugs.yaml',
                __DIR__ . '/../../../app/drugCategories.yaml',
            ),
            __DIR__ . '/../../../app/drugs.yaml'
        );
    }

    public function testCreate(): void
    {
        $drugs        = $this->sut->create(['Mosószer' => 4, 'Öblítő' => 2]);
        $drugCategory = new DrugCategory('Tisztítószer', 5, 1);

        $this->assertEquals(
            [
                new DrugForShopping('Mosószer', $drugCategory, 4, null, Measure::L),
                new DrugForShopping('Öblítő', $drugCategory, 2, null, Measure::L),
            ],
            $drugs->toArray()
        );
    }
}
