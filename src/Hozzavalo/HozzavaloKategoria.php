<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

enum HozzavaloKategoria: string implements Kategoria
{
    case ZOLDSEG = 'Zöldség';
    case FUSZER_ES_OLAJ = 'Fűszer és Olaj';
    case HOSSZU_SOROK = 'Hosszú sorok';
    case HUS = 'Hús';
    case HUTOS = 'Hűtős';
    case MIRELIT = 'Mirelit';
    case TEJTERMEK = 'Tejtermék';
    case HUTOS_UTAN = 'Hűtős után';
    case UDITOK = 'Üditők';

    #[\Override] public function value(): string
    {
        return $this->value;
    }
}
