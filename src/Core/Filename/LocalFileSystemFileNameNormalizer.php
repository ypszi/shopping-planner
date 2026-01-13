<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Filename;

class LocalFileSystemFileNameNormalizer implements FileNameNormalizer
{
    private const FORBIDDEN_FILENAME_CHARS = [
        '~',
        '/',
        '%',
    ];

    public function normalize(string $filename): string
    {
        $filename = preg_replace(pattern: '#[' . implode('', self::FORBIDDEN_FILENAME_CHARS) . ']#', replacement: '', subject: $filename);

        return preg_replace(pattern: '/\s{2,}/', replacement: ' ', subject: $filename);
    }
}
