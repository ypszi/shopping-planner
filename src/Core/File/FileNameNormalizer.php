<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\File;

interface FileNameNormalizer
{
    public function normalize(string $filename): string;
}
