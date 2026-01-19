<?php

declare(strict_types=1);

namespace Core\Storage;

use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\Product;
use PeterPecosz\ShoppingPlanner\Core\Storage\ThumbnailExtensionStorage;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class ThumbnailExtensionStorageTest extends TestCase
{
    private const TEST_PRODUCT_NAME = 'Fogkrém';

    private string $yamlPath;

    protected function setUp(): void
    {
        parent::setUp();

        $originalFilePath = __DIR__ . '/../../../app/drugs.yaml';
        $this->yamlPath   = __DIR__ . '/../../../app/test.yaml';

        copy($originalFilePath, $this->yamlPath);
    }

    #[Test]
    public function testGetThumbnailExtension(): void
    {
        $product = $this->createMock(Product::class);
        $product->method('name')->willReturn(self::TEST_PRODUCT_NAME);

        $thumbnailExtension = (new ThumbnailExtensionStorage($this->yamlPath))->getThumbnailExtension($product);

        $this->assertEquals(Extension::PNG, $thumbnailExtension);
    }

    #[Test]
    public function testAssignExtension(): void
    {
        $rawProducts = Yaml::parseFile($this->yamlPath);

        unset($rawProducts[self::TEST_PRODUCT_NAME]['thumbnailExtension']);

        file_put_contents(
            $this->yamlPath,
            Yaml::dump(
                input : $rawProducts,
                inline: 6,
                flags : Yaml::DUMP_COMPACT_NESTED_MAPPING
            )
        );

        $product = $this->createMock(Product::class);
        $product->method('name')->willReturn(self::TEST_PRODUCT_NAME);

        $sut = new ThumbnailExtensionStorage($this->yamlPath);
        $sut->assignExtension($product, Extension::JPG);
        $sut->__destruct();

        $rawProducts = Yaml::parseFile($this->yamlPath);
        $rawProduct  = $rawProducts[self::TEST_PRODUCT_NAME];

        $this->assertEquals(Extension::JPG->value, $rawProduct['thumbnailExtension']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unlink($this->yamlPath);
    }
}
