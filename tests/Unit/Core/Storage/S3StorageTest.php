<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Unit\Core\Storage;

use Aws\S3\S3ClientInterface;
use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\File\File;
use PeterPecosz\ShoppingPlanner\Core\File\FileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Core\Storage\S3Storage;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class S3StorageTest extends TestCase
{
    private FileNameNormalizer&MockObject $fileNameNormalizer;

    private S3ClientInterface&MockObject $client;

    private string $filePath;

    private string $assetPath;

    private S3Storage $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new S3Storage(
            filenameNormalizer: $this->fileNameNormalizer = $this->createMock(FileNameNormalizer::class),
            client            : $this->client = $this->createMock(S3ClientInterface::class),
            bucket            : 'test-bucket-1',
            region            : 'test-region-eu-north-1',
            thumbnailCachePath: $this->filePath = '/tmp/',
            thumbnailWebPath  : $this->assetPath = 'thumbnails/foods/',
        );
    }

    #[Test]
    public function testGet(): void
    {
        $fileName = 'Alpesi Sajtos-Tészta (Älplermagronen)';

        $this->fileNameNormalizer
            ->expects($this->once())
            ->method('normalize')
            ->with($fileName)
            ->willReturn($normalizedFileName = str_replace('-', '', $fileName));

        $this->client
            ->expects($this->once())
            ->method('__call')
            ->with(
                'getObject',
                [
                    [
                        'Bucket' => 'test-bucket-1',
                        'Key'    => $normalizedFileName . '.' . Extension::JPG->value,
                    ],
                ]
            )
            ->willReturn(['Body' => 'binary data']);

        $thumbnail = $this->sut->get(
            fileName : $fileName,
            extension: Extension::JPG,
        );

        $this->assertEquals(
            new Thumbnail(
                filePath : $this->filePath . $normalizedFileName . '.' . Extension::JPG->value,
                assetPath: 'https://test-bucket-1.s3.test-region-eu-north-1.amazonaws.com/' . $this->assetPath . $normalizedFileName . '.' . Extension::JPG->value,
                extension: Extension::JPG,
            ),
            $thumbnail
        );
    }

    #[Test]
    public function testSave(): void
    {
        $fileName    = 'Alpesi Sajtos-Tészta (Älplermagronen)';
        $fileContent = file_get_contents(__DIR__ . '/mock-image.jpg');

        $this->fileNameNormalizer
            ->expects($this->once())
            ->method('normalize')
            ->with($fileName)
            ->willReturn($normalizedFileName = str_replace('-', '', $fileName));

        $this->client
            ->expects($this->once())
            ->method('__call')
            ->with(
                'putObject',
                [
                    [
                        'Bucket' => 'test-bucket-1',
                        'Key'    => $normalizedFileName . '.' . Extension::JPG->value,
                        'Body'   => $fileContent,
                    ],
                ]
            );

        $thumbnail = $this->sut->save(
            new File(
                fileName: $fileName,
                mimeType: 'image/jpeg',
                content : $fileContent,
            )
        );

        $this->assertEquals(
            new Thumbnail(
                filePath : $this->filePath . $normalizedFileName . '.' . Extension::JPG->value,
                assetPath: 'https://test-bucket-1.s3.test-region-eu-north-1.amazonaws.com/' . $this->assetPath . $normalizedFileName . '.' . Extension::JPG->value,
                extension: Extension::JPG,
            ),
            $thumbnail
        );
    }
}
