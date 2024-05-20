<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

enum HozzavaloKategoria: string implements Kategoria
{
    case BOR = 'Bor';
    case ZOLDSEG = 'Zöldség';
    case OLAJ = 'Olaj';
    case FUSZER = 'Fűszer';
    case TARTOS_ELELMISZER = 'Tartós élelmiszer';
    case TARTOS_TEJTERMEK = 'Tartós tejtermék';
    case AZSIAI = 'Ázsiai';
    case FELVAGOTT = 'Felvágott';
    case HUS = 'Hús';
    case MIRELIT = 'Mirelit';
    case TEJTERMEK = 'Tejtermék';
    case UDITO = 'Üditő';
    case PEKARU = 'Pékárú';

    #[\Override] public function value(): string
    {
        return $this->value;
    }
}
