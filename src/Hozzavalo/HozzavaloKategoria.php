<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

class HozzavaloKategoria
{
    final public const string ZOLDSEG = 'Zöldség';
    final public const string FUSZER_ES_OLAJ = 'Fűszer és Olaj';
    final public const string HOSSZU_SOROK = 'Hosszú sorok';
    final public const string HUS = 'Hús';
    final public const string HUTOS = 'Hűtős';
    final public const string HUTOS_UTAN = 'Hűtős után';
    final public const string UDITOK = 'Üditők';
    // Kaufland sorrend
    final public const array SORREND = [
        self::ZOLDSEG,
        self::FUSZER_ES_OLAJ,
        self::HOSSZU_SOROK,
        self::HUS,
        self::HUTOS,
        self::HUTOS_UTAN,
        self::UDITOK,
    ];
}
