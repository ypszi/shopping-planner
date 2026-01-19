<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Storage;

use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\Product;
use Symfony\Component\Yaml\Yaml;

class ThumbnailExtensionStorage
{
    /** @var string[] */
    private const ORDER = [
        'kategoria',
        'defaultPortion',
        'receptUrl',
        'thumbnailUrl',
        'thumbnailExtension',
        'tags',
        'ingredients',
        'storage',
        'cookingSteps',
        'comments',
    ];

    /** @var array<string, array<string, mixed>> */
    private array $products;

    private bool $hasChanged = false;

    public function __construct(
        private readonly string $yamlPath,
    ) {
        $this->products = Yaml::parseFile($yamlPath);
    }

    public function getThumbnailExtension(Product $product): Extension
    {
        $rawProduct = $this->products[$product->name()];

        return Extension::from($rawProduct['thumbnailExtension']);
    }

    public function assignExtension(Product $product, Extension $extension): void
    {
        $rawProduct = $this->products[$product->name()];

        if (isset($rawProduct['thumbnailExtension'])) {
            return;
        }

        $rawProduct['thumbnailExtension'] = $extension->value;

        uksort(
            $rawProduct,
            function ($key1, $key2) {
                return array_search($key1, self::ORDER) <=> array_search($key2, self::ORDER);
            }
        );

        $this->products[$product->name()] = $rawProduct;
        $this->hasChanged                 = true;
    }

    public function __destruct()
    {
        if (!$this->hasChanged) {
            return;
        }

        file_put_contents(
            $this->yamlPath,
            Yaml::dump(
                input : $this->products,
                inline: 6,
                flags : Yaml::DUMP_COMPACT_NESTED_MAPPING
            )
        );
    }
}
