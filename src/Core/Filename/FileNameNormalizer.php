<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Filename;

interface FileNameNormalizer
{
    public function normalize(string $filename): string;
}
