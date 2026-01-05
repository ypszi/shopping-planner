<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
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
                $this->createMock(ThumbnailFactory::class),
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
                new DrugForShopping(
                    name             : 'Mosószer',
                    category         : $drugCategory,
                    defaultPortion   : 1,
                    portion          : 4,
                    measure          : null,
                    measurePreference: Measure::L
                ),
                new DrugForShopping(
                    name             : 'Öblítő',
                    category         : $drugCategory,
                    defaultPortion   : 1,
                    portion          : 2,
                    measure          : null,
                    measurePreference: Measure::L
                ),
            ],
            $drugs->toArray()
        );
    }
}
