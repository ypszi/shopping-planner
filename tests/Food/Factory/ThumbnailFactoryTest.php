<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Food\Factory;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Request;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class ThumbnailFactoryTest extends TestCase
{
    private ClientInterface&MockObject $httpClient;

    private string $filePath;

    private string $assetPath;

    /** @var string[] */
    private array $savedFileNames;

    private ThumbnailFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new ThumbnailFactory(
            $this->httpClient = $this->createMock(ClientInterface::class),
            $this->filePath = __DIR__ . '/../../../var/cache/',
            $this->assetPath = '/'
        );
    }

    #[Test]
    public function testCreate(): void
    {
        $thumbnailUrl = 'https://cdn.foods.com/Bolognai.jpg';

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
            ->willReturn('image/jpeg');

        $thumbnail = $this->sut->create(
            foodName:     'Bolognai',
            thumbnailUrl: $thumbnailUrl
        );

        $fileName               = 'Bolognai.jpg';
        $this->savedFileNames[] = $fileName;

        $this->assertEquals($this->assetPath . $fileName, $thumbnail);
    }

    protected function tearDown(): void
    {
        foreach ($this->savedFileNames as $savedFileName) {
            unlink($this->filePath . $savedFileName);
        }

        parent::tearDown();
    }
}
