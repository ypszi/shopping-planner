<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Storage;

use PeterPecosz\ShoppingPlanner\Core\File\Extension;
use PeterPecosz\ShoppingPlanner\Core\File\File;
use PeterPecosz\ShoppingPlanner\Food\Thumbnail;

interface Storage
{
    public function get(string $filename, Extension $extension): ?Thumbnail;

    public function save(File $file): Thumbnail;
}
