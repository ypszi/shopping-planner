<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Drug;
use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugShoppingListFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DrugShoppingListFactoryTest extends TestCase
{
    private ThumbnailFactory&MockObject $thumbnailFactory;

    private DrugShoppingListFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new DrugShoppingListFactory(
            new DrugsFactory(
                new DrugFactory(
                    Resource::Drugs->value,
                    Resource::DrugCategories->value,
                    $this->thumbnailFactory = $this->createMock(ThumbnailFactory::class),
                ),
                Resource::Drugs->value,
            )
        );
    }

    public function testCreate(): void
    {
        $this->thumbnailFactory
            ->expects($this->atLeast(5))
            ->method('create')
            ->with($this->isInstanceOf(Drug::class));

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
