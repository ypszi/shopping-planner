<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

enum HozzavaloKategoria: string implements Kategoria
{
    case BOR = 'Bor';
    case ZOLDSEG = 'Zöldség';
    case FUSZER_ES_OLAJ = 'Fűszer és Olaj';
    case OLAJ = 'Olaj';
    case FUSZER = 'Fűszer';
    case HOSSZU_SOROK = 'Hosszú sorok';
    case FELVAGOTT = 'Felvágott';
    case HUS = 'Hús';
    case HUTOS = 'Hűtős';
    case MIRELIT = 'Mirelit';
    case TEJTERMEK = 'Tejtermék';
    case HUTOS_UTAN = 'Hűtős után';
    case UDITOK = 'Üditők';
    case PEKARU = 'Pékárú';

    #[\Override] public function value(): string
    {
        return $this->value;
    }
}
