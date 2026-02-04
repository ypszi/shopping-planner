<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\File;

class S3FileNameNormalizer implements FileNameNormalizer
{
    public function normalize(string $filename): string
    {
        return hash('sha256', mb_strtolower(trim($filename)));
    }
}
