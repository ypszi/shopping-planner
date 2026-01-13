<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Storage;

use PeterPecosz\ShoppingPlanner\Core\Filename\FileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;

readonly class LocalFileSystemStorage implements Storage
{
    public function __construct(
        private FileNameNormalizer $filenameNormalizer,
        private string $thumbnailCachePath,
        private string $thumbnailWebPath,
    ) {
    }

    public function get(string $filename): ?Thumbnail
    {
        foreach (File::getAvailableExtensions() as $extension) {
            $fileName = $this->filenameNormalizer->normalize($filename) . '.' . $extension->value;

            if (file_exists($this->thumbnailCachePath . $fileName)) {
                return new Thumbnail(
                    $this->thumbnailCachePath . $fileName,
                    $this->thumbnailWebPath . $fileName,
                    $extension
                );
            }
        }

        return null;
    }

    public function save(File $file): Thumbnail
    {
        $fileName  = $this->filenameNormalizer->normalize($file->fileName) . '.' . $file->getExtension()->value;
        $thumbnail = new Thumbnail(
            $this->thumbnailCachePath . $fileName,
            $this->thumbnailWebPath . $fileName,
            $file->getExtension()
        );

        if (!is_dir($this->thumbnailCachePath)) {
            mkdir($this->thumbnailCachePath, 0755, true);
        }

        if (!file_exists($thumbnail->getFilePath())) {
            touch($thumbnail->getFilePath());
        }

        file_put_contents($thumbnail->getFilePath(), $file->content);

        return $thumbnail;
    }
}
