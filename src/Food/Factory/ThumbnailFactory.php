<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\Factory;

use PeterPecosz\ShoppingPlanner\Core\File\FileDownloader;
use PeterPecosz\ShoppingPlanner\Core\Product;
use PeterPecosz\ShoppingPlanner\Core\Storage\Storage;
use PeterPecosz\ShoppingPlanner\Core\Storage\ThumbnailExtensionStorage;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;

readonly class ThumbnailFactory
{
    public function __construct(
        private FileDownloader $fileDownloader,
        private Storage $storage,
        private ThumbnailExtensionStorage $thumbnailExtensionStorage,
    ) {
    }

    public function create(Product $product): ?Thumbnail
    {
        $thumbnailUrl = $product->thumbnailUrl();

        if (empty($thumbnailUrl)) {
            return null;
        }

        $thumbnail = $this->find($product);

        if ($thumbnail) {
            return $thumbnail;
        }

        $file = $this->fileDownloader->download($thumbnailUrl);

        if (!$file) {
            return null;
        }

        $file = $file->withFileName($product->name());

        $this->thumbnailExtensionStorage->assignExtension($product, $file->extension());

        return $this->storage->save($file);
    }

    private function find(Product $product): ?Thumbnail
    {
        $thumbnailUrl = $product->thumbnailUrl();

        if (empty($thumbnailUrl)) {
            return null;
        }

        $extension = $this->thumbnailExtensionStorage->getThumbnailExtension($product);

        if (!$extension) {
            return null;
        }

        return $this->storage->get(
            filename : $product->name(),
            extension: $extension
        );
    }
}
