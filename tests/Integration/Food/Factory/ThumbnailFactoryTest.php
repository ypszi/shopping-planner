<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Integration\Food\Factory;

use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\File\File;
use PeterPecosz\ShoppingPlanner\Core\File\FileDownloader;
use PeterPecosz\ShoppingPlanner\Core\Product;
use PeterPecosz\ShoppingPlanner\Core\Storage\Storage;
use PeterPecosz\ShoppingPlanner\Core\Storage\ThumbnailExtensionStorage;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ThumbnailFactoryTest extends TestCase
{
    private FileDownloader&MockObject $fileDownloader;

    private Storage&MockObject $storage;

    private ThumbnailExtensionStorage&MockObject $thumbnailExtensionStorage;

    private ThumbnailFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new ThumbnailFactory(
            $this->fileDownloader = $this->createMock(FileDownloader::class),
            $this->storage = $this->createMock(Storage::class),
            $this->thumbnailExtensionStorage = $this->createMock(ThumbnailExtensionStorage::class),
        );
    }

    #[Test]
    public function testCreateWhenNotFound(): void
    {
        $foodName     = 'Bolognai';
        $thumbnailUrl = 'https://cdn.foods.com/Bolognai.jpg';
        $product      = $this->createMock(Product::class);
        $product
            ->expects($this->exactly(2))
            ->method('name')
            ->willReturn($foodName);
        $product
            ->expects($this->exactly(2))
            ->method('thumbnailUrl')
            ->willReturn($thumbnailUrl);

        $this->thumbnailExtensionStorage
            ->expects($this->once())
            ->method('getThumbnailExtension')
            ->with($product)
            ->willReturn(Extension::JPG);

        $this->storage
            ->expects($this->once())
            ->method('get')
            ->with($foodName, Extension::JPG)
            ->willReturn(null);

        $this->fileDownloader
            ->expects($this->once())
            ->method('download')
            ->with($thumbnailUrl)
            ->willReturn($file = $this->createMock(File::class));

        $file
            ->expects($this->once())
            ->method('withFileName')
            ->with($foodName)
            ->willReturn($file);

        $file
            ->expects($this->once())
            ->method('extension')
            ->willReturn(Extension::JPG);

        $this->thumbnailExtensionStorage
            ->expects($this->once())
            ->method('assignExtension')
            ->with($product, Extension::JPG);

        $this->storage
            ->expects($this->once())
            ->method('save')
            ->with($file)
            ->willReturn(
                $createdThumbnail = new Thumbnail(
                    filePath : '/tmp/assets/' . $foodName,
                    assetPath: 'web/assets/' . $foodName,
                    extension: Extension::JPG
                )
            );

        $thumbnail = $this->sut->create($product);

        $this->assertEquals($createdThumbnail, $thumbnail);
    }

    #[Test]
    public function testCreateWhenFound(): void
    {
        $foodName = 'Bolognai';
        $product  = $this->createMock(Product::class);
        $product
            ->expects($this->once())
            ->method('name')
            ->willReturn($foodName);
        $product
            ->expects($this->exactly(2))
            ->method('thumbnailUrl')
            ->willReturn('https://cdn.foods.com/Bolognai.jpg');

        $this->thumbnailExtensionStorage
            ->expects($this->once())
            ->method('getThumbnailExtension')
            ->with($product)
            ->willReturn(Extension::JPG);

        $this->storage
            ->expects($this->once())
            ->method('get')
            ->with($foodName, Extension::JPG)
            ->willReturn(
                $foundThumbnail = new Thumbnail(
                    filePath : '/tmp/assets/' . $foodName,
                    assetPath: 'web/assets/' . $foodName,
                    extension: Extension::JPG
                )
            );

        $this->fileDownloader
            ->expects($this->never())
            ->method('download');

        $this->thumbnailExtensionStorage
            ->expects($this->never())
            ->method('assignExtension');

        $this->storage
            ->expects($this->never())
            ->method('save');

        $thumbnail = $this->sut->create($product);

        $this->assertEquals($foundThumbnail, $thumbnail);
    }
}
