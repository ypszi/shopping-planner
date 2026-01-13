<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Storage;

use InvalidArgumentException;

class File
{
    public const MIME_TYPE_EXTENSION_MAP = [
        'image/jpeg' => Extension::JPG,
        'image/png'  => Extension::PNG,
        'image/webp' => Extension::WEBP,
    ];

    private Extension $extension;

    public function __construct(
        public readonly string $fileName,
        string $mimeType,
        public readonly mixed $content,
    ) {
        if (!self::isMimeTypeValid($mimeType)) {
            throw new InvalidArgumentException(sprintf('Mime type "%s" is not supported.', $mimeType));
        }

        $this->extension = self::MIME_TYPE_EXTENSION_MAP[$mimeType];
    }

    public static function isMimeTypeValid(string $mimetype): bool
    {
        return isset(self::MIME_TYPE_EXTENSION_MAP[$mimetype]);
    }

    /**
     * @return Extension[]
     */
    public static function getAvailableExtensions(): array
    {
        return array_values(self::MIME_TYPE_EXTENSION_MAP);
    }

    public function getExtension(): Extension
    {
        return $this->extension;
    }
}
