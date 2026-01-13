<?php

declare(strict_types=1);

namespace Core\Storage;

use PeterPecosz\ShoppingPlanner\Core\Filename\FileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Core\Storage\Extension;
use PeterPecosz\ShoppingPlanner\Core\Storage\File;
use PeterPecosz\ShoppingPlanner\Core\Storage\LocalFileSystemStorage;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class LocalFileSystemStorageTest extends TestCase
{
    private FileNameNormalizer&MockObject $fileNameNormalizer;

    private string $filePath;

    private string $assetPath;

    private LocalFileSystemStorage $sut;

    /** @var string[] */
    private array $savedFileNames;

    protected function setUp(): void
    {
        parent::setUp();

        $this->savedFileNames = [];

        $this->sut = new LocalFileSystemStorage(
            $this->fileNameNormalizer = $this->createMock(FileNameNormalizer::class),
            $this->filePath = __DIR__ . '/../../../var/cache/',
            $this->assetPath = '/',
        );
    }

    protected function tearDown(): void
    {
        foreach ($this->savedFileNames as $savedFileName) {
            unlink($this->filePath . $savedFileName);
        }

        $this->savedFileNames = [];

        parent::tearDown();
    }

    #[Test]
    public function testGetNotFound(): void
    {
        $fileName = 'Alpesi Sajtos-Tészta (~Älplermagronen) / Alpesi_Macaroni';

        $this->fileNameNormalizer
            ->expects($this->exactly(3))
            ->method('normalize')
            ->with()
            ->willReturn($fileName);

        file_put_contents(
            $this->filePath . $fileName . '.' . Extension::JPG->value,
            file_get_contents(__DIR__ . '/mock-image.jpg')
        );

        $thumbnail = $this->sut->get($fileName);

        $this->assertNull($thumbnail);
    }

    #[Test]
    public function testGet(): void
    {
        $fileName = 'Alpesi Sajtos-Tészta (Älplermagronen) Alpesi_Macaroni';

        copy(
            __DIR__ . '/mock-image.jpg',
            $this->filePath . $fileName . '.' . Extension::JPG->value,
        );

        $this->fileNameNormalizer
            ->expects($this->once())
            ->method('normalize')
            ->with()
            ->willReturn($fileName);

        $thumbnail = $this->sut->get($fileName);

        unlink($this->filePath . $fileName . '.' . Extension::JPG->value);

        $this->assertEquals(
            new Thumbnail(
                filePath : $this->filePath . $fileName . '.' . Extension::JPG->value,
                assetPath: $this->assetPath . $fileName . '.' . Extension::JPG->value,
                extension: Extension::JPG,
            ),
            $thumbnail
        );
    }

    #[Test]
    public function testSave(): void
    {
        $fileName = 'Alpesi Sajtos-Tészta (Älplermagronen)';

        $this->fileNameNormalizer
            ->expects($this->once())
            ->method('normalize')
            ->with($fileName)
            ->willReturn($fileName);

        $thumbnail = $this->sut->save(
            new File(
                fileName: $fileName,
                mimeType: 'image/jpeg',
                content : file_get_contents(__DIR__ . '/mock-image.jpg'),
            )
        );

        $this->savedFileNames[] = $fileName . '.' . Extension::JPG->value;

        $this->assertEquals(
            new Thumbnail(
                filePath : $this->filePath . $fileName . '.' . Extension::JPG->value,
                assetPath: $this->assetPath . $fileName . '.' . Extension::JPG->value,
                extension: Extension::JPG,
            ),
            $thumbnail
        );
        $this->assertFileExists($this->filePath . $fileName . '.' . Extension::JPG->value);
    }
}
