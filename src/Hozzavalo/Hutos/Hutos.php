<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Hutos;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;

class Hutos extends Hozzavalo
{
    #[\Override] public static function kategoria(): string
    {
        return HozzavaloKategoria::HUTOS;
    }
}
