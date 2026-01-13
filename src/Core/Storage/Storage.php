<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Storage;

use PeterPecosz\ShoppingPlanner\Food\Thumbnail;

interface Storage
{
    public function get(string $filename): ?Thumbnail;

    public function save(File $file): Thumbnail;
}
