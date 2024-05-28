<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum AuchanLuxembourgKategoria: string implements Kategoria
{
    case UDITO = 'Üditő';
    case KONZERV_SZOSZ_OLAJ_ECET_FUSZER = 'Konzerv, Szósz, Olaj, Ecet, Fűszer';
    case TESZTA_RIZS_PARADICSOMSZOSZ_PURE = 'Tészta, Rizs, Paradicsomszósz, Puré';
    case TEA_KAVE = 'Tea, Kávé';
    case CUKRASZ_KEKSZ = 'Cukrász, Keksz';
    case NEMZETKOZI = 'Nemzetközi';
    case MIRELIT = 'Mirelit';
    case SAJT = 'Sajt';
    case TARTOS_TEJTERMEK = 'Tartós tejtermék';
    case TEJTERMEK = 'Tejtermék';
    case HUS = 'Hús';
    case FELVAGOTT = 'Felvágott';
    case JOGHURT = 'Joghurt';
    case ZOLDSEG_GYUMOLCS = 'Zöldség / Gyümölcs';
    case HAL = 'Hal';
    case PEKARU = 'Pékárú';

    public function value(): string
    {
        return $this->value;
    }
}
