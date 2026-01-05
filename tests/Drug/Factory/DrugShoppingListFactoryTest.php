<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugShoppingListFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
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
                    __DIR__ . '/../../../app/drugCategories.yaml',
                    $this->createMock(ThumbnailFactory::class),
                ),
                __DIR__ . '/../../../app/drugs.yaml',
            )
        );
    }

    public function testCreate(): void
    {
        $drugs = $this->sut->create(
            [
                'Mosószer'          => 4,
                'Dezodor (férfi)'   => 1,
                'Folyékony szappan' => 200,
                'Öblítő'            => 2,
                'Papírtörlő'        => 1,
            ]
        );

        $this->assertEquals(
            [
                'header' => [
                    'Tisztálkodás',
                    'Tisztítószer',
                ],
                'rows'   => [
                    [
                        new DrugForShopping(
                            name             : 'Dezodor (férfi)',
                            category         : new DrugCategory('Tisztálkodás', 5, 1),
                            defaultPortion   : 1,
                            portion          : 1,
                            measure          : null,
                            measurePreference: Measure::DB
                        ),
                        new DrugForShopping(
                            name             : 'Mosószer',
                            category         : new DrugCategory('Tisztítószer', 5, 1),
                            defaultPortion   : 1,
                            portion          : 4,
                            measure          : null,
                            measurePreference: Measure::L
                        ),
                    ],
                    [
                        new DrugForShopping(
                            name             : 'Folyékony szappan',
                            category         : new DrugCategory('Tisztálkodás', 500, 100),
                            defaultPortion   : 200,
                            portion          : 200,
                            measure          : null,
                            measurePreference: Measure::ML
                        ),
                        new DrugForShopping(
                            name             : 'Öblítő',
                            category         : new DrugCategory('Tisztítószer', 5, 1),
                            defaultPortion   : 1,
                            portion          : 2,
                            measure          : null,
                            measurePreference: Measure::L
                        ),
                    ],
                    [
                        '',
                        new DrugForShopping(
                            name             : 'Papírtörlő',
                            category         : new DrugCategory('Tisztítószer', 5, 1),
                            defaultPortion   : 1,
                            portion          : 1,
                            measure          : null,
                            measurePreference: Measure::DB
                        ),
                    ],
                ],
            ],
            $drugs
        );
    }
}
