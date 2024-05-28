<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum LidlWasserbilligKategoria: string implements Kategoria
{
    case MUZLI_PEKARU = 'Müzli/ Pékárú';
    case ZOLDSEG_GYUMOLCS = 'Zöldség / Gyümölcs';
    case KAVE_TEA_KEKSZ = 'Kave / Tea / Keksz';
    case FELVAGOTT = 'Felvágott';
    case HUS = 'Hús';
    case FUSZER_HAL = 'Fűszer / Hal';
    case SAJT = 'Sajt';
    case TEJTERMEK = 'Tejtermék';
    case UDITO = 'Üditő';
    case MIRELIT = 'Mirelit';
    case SOS_RAGCSA_SOR_BOR = 'Sós rágcsa / Sör / Bor';
    case TARTOS_ELELMISZER = 'Tartós tejtermék / Csoki / Tojás / Olaj / Ecet / Tészta / Konzerv';

    public function value(): string
    {
        return $this->value;
    }
}
