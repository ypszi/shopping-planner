<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

interface KategoriaMap
{
    public static function map(Kategoria $kategoria): Kategoria;
}
