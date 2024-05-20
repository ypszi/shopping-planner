<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

interface HozzavaloToKategoriaMap
{
    public function map(Hozzavalo $hozzavalo): Kategoria;
}
