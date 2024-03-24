<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;

class Zoldseg extends Hozzavalo
{
    #[\Override] public static function kategoria(): string
    {
        return HozzavaloKategoria::ZOLDSEG;
    }
}
