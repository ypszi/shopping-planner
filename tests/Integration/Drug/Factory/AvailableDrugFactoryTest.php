<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Factory\AvailableDrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Tests\Support\AvailableCount;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AvailableDrugFactoryTest extends TestCase
{
    private ThumbnailFactory&MockObject $thumbnailFactory;

    private AvailableDrugFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableDrugFactory(
            new DrugFactory(
                Resource::Drugs->value,
                Resource::DrugCategories->value,
                $this->thumbnailFactory = $this->createMock(ThumbnailFactory::class),
            ),
            Resource::Drugs->value,
        );
    }

    #[Test]
    public function testListAvailableDrugs(): void
    {
        $this->thumbnailFactory
            ->expects($this->exactly(AvailableCount::getDrugCount()))
            ->method('create');

        $this->assertCount(AvailableCount::getDrugCount(), $this->sut->listAvailableDrugs());
    }
}
