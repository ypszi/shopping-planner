<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;

class FuszerEsOlaj extends Hozzavalo
{
    #[\Override] public static function kategoria(): string
    {
        return HozzavaloKategoria::FUSZER_ES_OLAJ;
    }
}
