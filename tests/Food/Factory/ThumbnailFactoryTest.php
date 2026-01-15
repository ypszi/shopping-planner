<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Request;
use PeterPecosz\ShoppingPlanner\Core\Product;
use PeterPecosz\ShoppingPlanner\Core\Storage\Extension;
use PeterPecosz\ShoppingPlanner\Core\Storage\File;
use PeterPecosz\ShoppingPlanner\Core\Storage\Storage;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ThumbnailFactoryTest extends TestCase
{
    private ClientInterface&MockObject $httpClient;

    private Storage&MockObject $storage;

    private ThumbnailFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new ThumbnailFactory(
            $this->httpClient = $this->createMock(ClientInterface::class),
            $this->storage = $this->createMock(Storage::class),
        );
    }

    #[Test]
    public function testCreateWhenNotFound(): void
    {
        $foodName     = 'Bolognai';
        $thumbnailUrl = 'https://cdn.foods.com/Bolognai.jpg';

        $this->storage
            ->expects($this->once())
            ->method('get')
            ->with($foodName)
            ->willReturn(null);

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->with(new Request('GET', $thumbnailUrl))
            ->willReturn($response = $this->createMock(ResponseInterface::class));

        $response
            ->method('getStatusCode')
            ->willReturn(StatusCodeInterface::STATUS_OK);

        $response
            ->method('getHeaderLine')
            ->with('Content-Type')
            ->willReturn($mimeType = 'image/jpeg');

        $stream = $this->createMock(StreamInterface::class);
        $response
            ->method('getBody')
            ->willReturn($stream);

        $stream
            ->method('__toString')
            ->willReturn($content = 'fileContent');

        $this->storage
            ->expects($this->once())
            ->method('save')
            ->with(
                new File(
                    fileName: $foodName,
                    mimeType: $mimeType,
                    content : $content
                )
            )
            ->willReturn(
                $createdThumbnail = new Thumbnail(
                    filePath : '/tmp/assets/' . $foodName,
                    assetPath: 'web/assets/' . $foodName,
                    extension: Extension::JPG
                )
            );

        $product = $this->createMock(Product::class);
        $product->method('name')->willReturn($foodName);

        $thumbnail = $this->sut->create(
            product     : $product,
            thumbnailUrl: $thumbnailUrl
        );

        $this->assertEquals($createdThumbnail, $thumbnail);
    }

    #[Test]
    public function testCreateWhenFound(): void
    {
        $foodName = 'Bolognai';

        $this->storage
            ->expects($this->once())
            ->method('get')
            ->with($foodName)
            ->willReturn(
                $foundThumbnail = new Thumbnail(
                    filePath : '/tmp/assets/' . $foodName,
                    assetPath: 'web/assets/' . $foodName,
                    extension: Extension::JPG
                )
            );

        $this->httpClient
            ->expects($this->never())
            ->method('sendRequest');

        $product = $this->createMock(Product::class);
        $product->method('name')->willReturn($foodName);

        $thumbnail = $this->sut->create(
            product     : $product,
            thumbnailUrl: 'https://cdn.foods.com/Bolognai.jpg'
        );

        $this->assertEquals($foundThumbnail, $thumbnail);
    }
}
