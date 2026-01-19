<?php

declare(strict_types=1);

namespace Core\File;

use Fig\Http\Message\StatusCodeInterface;
use GuzzleHttp\Psr7\Request;
use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\File\FileDownloader;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class FileDownloaderTest extends TestCase
{
    private ClientInterface&MockObject $httpClient;

    private FileDownloader $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new FileDownloader(
            $this->httpClient = $this->createMock(ClientInterface::class)
        );
    }

    #[Test]
    public function testDownload(): void
    {
        $url = 'https://cdn.foods.com/Bolognai.jpg';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->with(new Request('GET', $url))
            ->willReturn($response = $this->createMock(ResponseInterface::class));

        $response
            ->method('getStatusCode')
            ->willReturn(StatusCodeInterface::STATUS_OK);

        $response
            ->method('getHeaderLine')
            ->with('Content-Type')
            ->willReturn('image/jpeg');

        $stream = $this->createMock(StreamInterface::class);
        $response
            ->method('getBody')
            ->willReturn($stream);

        $stream
            ->method('__toString')
            ->willReturn('fileContent');

        $file = $this->sut->download($url);

        $this->assertMatchesRegularExpression('/[a-z0-9]{64}/', $file->fileName());
        $this->assertEquals(Extension::JPG, $file->extension());
    }

    #[Test]
    public function testDownloadUsingRedirect(): void
    {
        $url           = 'https://cdn.foods.com/Bolognai.jpg';
        $redirectedUrl = 'https://cdn-eu.foods.com/Bolognai.jpg';
        $response      = $this->createMock(ResponseInterface::class);

        $this->httpClient
            ->expects($this->exactly(2))
            ->method('sendRequest')
            ->willReturnCallback(
                fn(Request $request) => match ((string)$request->getUri()) {
                    $url,
                    $redirectedUrl => $response,
                    default        => $this->fail(sprintf('Unexpected request: "%s"', $request->getUri()))
                }
            );

        $response
            ->method('getHeaderLine')
            ->willReturnCallback(
                fn(string $headerLine) => match ($headerLine) {
                    'Location'     => $redirectedUrl,
                    'Content-Type' => 'image/jpeg',
                    default        => $this->fail(sprintf('Unexpected header line: "%s"', $headerLine))
                }
            );

        $response
            ->method('getStatusCode')
            ->willReturnOnConsecutiveCalls(StatusCodeInterface::STATUS_FOUND, StatusCodeInterface::STATUS_OK);

        $stream = $this->createMock(StreamInterface::class);
        $response
            ->method('getBody')
            ->willReturn($stream);

        $stream
            ->method('__toString')
            ->willReturn('fileContent');

        $file = $this->sut->download($url);

        $this->assertMatchesRegularExpression('/[a-z0-9]{64}/', $file->fileName());
        $this->assertEquals(Extension::JPG, $file->extension());
    }

    #[Test]
    public function testDownloadFails(): void
    {
        $url = 'https://cdn.foods.com/Bolognai.jpg';

        $this->httpClient
            ->expects($this->once())
            ->method('sendRequest')
            ->with(new Request('GET', $url))
            ->willReturn($response = $this->createMock(ResponseInterface::class));

        $response
            ->method('getStatusCode')
            ->willReturn(StatusCodeInterface::STATUS_BAD_REQUEST);

        $file = $this->sut->download($url);

        $this->assertNull($file);
    }
}
