<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hus;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;

class Hus extends Hozzavalo
{
    #[\Override] public static function kategoria(): string
    {
        return HozzavaloKategoria::HUS;
    }
}
