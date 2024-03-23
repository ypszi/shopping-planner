<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

class Zoldseg extends Hozzavalo
{
    #[\Override] public static function kategoria(): string
    {
        return HozzavaloKategoria::ZOLDSEG;
    }
}
