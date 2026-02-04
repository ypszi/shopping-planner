<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food;

use PeterPecosz\ShoppingPlanner\Core\File\Extension;

readonly class Thumbnail
{
    public function __construct(
        private string $filePath,
        private string $assetPath,
        private Extension $extension
    ) {
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getAssetPath(): string
    {
        return $this->assetPath;
    }

    public function getExtension(): string
    {
        return $this->extension->value;
    }
}
