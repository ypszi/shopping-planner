<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Drug;
use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PeterPecosz\ShoppingPlanner\Tests\Support\Resource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DrugFactoryTest extends TestCase
{
    private ThumbnailFactory&MockObject $thumbnailFactory;

    private DrugFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new DrugFactory(
            Resource::Drugs->value,
            Resource::DrugCategories->value,
            $this->thumbnailFactory = $this->createMock(ThumbnailFactory::class),
        );
    }

    public function testCreateWithPortion(): void
    {
        $this->thumbnailFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Drug::class))
            ->willReturn(null);

        $drug = $this->sut->createWithPortion('Mosószer', 4);

        $this->assertEquals('Mosószer', $drug->name());
        $this->assertEquals(new DrugCategory('Tisztítószer', 5, 1), $drug->category());
        $this->assertEquals(Measure::L, $drug->measurePreference());
        $this->assertEquals(4, $drug->portion());
        $this->assertNull($drug->measure());
    }

    public function testCreate(): void
    {
        $this->thumbnailFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Drug::class))
            ->willReturn(null);

        $drug = $this->sut->create('Mosószer');

        $this->assertEquals('Mosószer', $drug->name());
        $this->assertEquals(new DrugCategory('Tisztítószer', 5, 1), $drug->category());
        $this->assertEquals(Measure::L, $drug->measurePreference());
    }

    public function testCreateWithThumbnail(): void
    {
        $this->thumbnailFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->isInstanceOf(Drug::class))
            ->willReturn($thumbnail = $this->createMock(Thumbnail::class));

        $thumbnail
            ->expects($this->once())
            ->method('getAssetPath')
            ->willReturn('thumbnails/Mosószer.jpg');

        $drug = $this->sut->create('Mosószer');

        $this->assertEquals('Mosószer', $drug->name());
        $this->assertEquals('thumbnails/Mosószer.jpg', $drug->thumbnailUrl());
    }
}
