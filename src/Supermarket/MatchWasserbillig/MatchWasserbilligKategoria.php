<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum MatchWasserbilligKategoria: string implements Kategoria
{
    case PEKARU = 'Pékárú';
    case ZOLDSEG_GYUMOLCS = 'Zöldség / Gyümölcs';
    case KAVE_TEA = 'Kávé / Tea';
    case BOR = 'Bor';
    case TARTOS_TEJTERMEK = 'Tartós tejtermék';
    case TEJTERMEK = 'Tejtermék';
    case SAJT = 'Sajt';
    case HUS = 'Hús';
    case HAL = 'Hal';
    case MIRELIT = 'Mirelit';
    case FELVAGOTT = 'Felvágott';
    case RIZS_TESZTA = 'Rizs / Tészta';
    case FUSZER = 'Fűszer';
    case AZSIAI = 'Ázsiai';
    case OLAJ_ECET = 'Olaj / Ecet';
    case KONZERV = 'Konzerv';
    case UDITO = 'Üditő';

    public function value(): string
    {
        return $this->value;
    }
}
