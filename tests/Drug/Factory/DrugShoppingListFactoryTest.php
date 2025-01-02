<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugShoppingListFactory;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use PHPUnit\Framework\TestCase;

class DrugShoppingListFactoryTest extends TestCase
{
    private DrugShoppingListFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new DrugShoppingListFactory(
            new DrugsFactory(
                new DrugFactory(
                    __DIR__ . '/../../../app/drugs.yaml',
                    __DIR__ . '/../../../app/drugCategories.yaml'
                ),
                __DIR__ . '/../../../app/drugs.yaml',
            )
        );
    }

    public function testCreate(): void
    {
        $drugs = $this->sut->create(['Mosószer' => 4, 'Dezodor' => 1, 'Öblítő' => 2]);

        $this->assertEquals(
            [
                'header' => [
                    'Tisztálkodás',
                    'Tisztítószer',
                ],
                'rows'   => [
                    [
                        new DrugForShopping(
                            'Dezodor',
                            new DrugCategory('Tisztálkodás', 500, 100),
                            1,
                            null,
                            Measure::ML
                        ),
                        new DrugForShopping(
                            'Mosószer',
                            new DrugCategory('Tisztítószer', 5, 1),
                            4,
                            null,
                            Measure::L
                        ),
                    ],
                    [
                        '',
                        new DrugForShopping(
                            'Öblítő',
                            new DrugCategory('Tisztítószer', 5, 1),
                            2,
                            null,
                            Measure::L
                        ),
                    ],
                ],
            ],
            $drugs
        );
    }
}
