<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\File;

use InvalidArgumentException;

class File
{
    private const MIME_TYPE_EXTENSION_MAP = [
        'image/jpeg' => Extension::JPG,
        'image/png'  => Extension::PNG,
        'image/webp' => Extension::WEBP,
    ];

    private Extension $extension;

    public function __construct(
        private string $fileName,
        string $mimeType,
        public readonly mixed $content,
    ) {
        if (!self::isMimeTypeValid($mimeType)) {
            throw new InvalidArgumentException(sprintf('Mime type "%s" is not supported.', $mimeType));
        }

        $this->extension = self::MIME_TYPE_EXTENSION_MAP[$mimeType];
    }

    public function fileName(): string
    {
        return $this->fileName;
    }

    public function withFileName(string $fileName): self
    {
        $clone           = clone $this;
        $clone->fileName = $fileName;

        return $clone;
    }

    public static function isMimeTypeValid(string $mimetype): bool
    {
        return isset(self::MIME_TYPE_EXTENSION_MAP[$mimetype]);
    }

    public function extension(): Extension
    {
        return $this->extension;
    }
}
