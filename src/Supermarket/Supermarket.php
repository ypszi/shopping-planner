<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;

interface Supermarket
{
    public static function name(): string;

    public function createHozzavaloSorok(Etelek $etelek): HozzavaloSorok;
}
