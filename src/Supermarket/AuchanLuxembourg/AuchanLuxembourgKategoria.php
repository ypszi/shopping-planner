<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum AuchanLuxembourgKategoria: string implements Kategoria
{
    case UDITO = HozzavaloKategoria::UDITO->value;
    case KONZERV_SZOSZ_OLAJ_ECET_FUSZER = 'Konzerv, Szósz, Olaj, Ecet, Fűszer';
    case TESZTA_RIZS_PARADICSOMSZOSZ_PURE = 'Tészta, Rizs, Paradicsomszósz, Puré';
    case TEA_KAVE = 'Tea, Kávé';
    case CUKRASZ_KEKSZ = 'Cukrász, Keksz';
    case NEMZETKOZI = 'Nemzetközi';
    case MIRELIT = HozzavaloKategoria::MIRELIT->value;
    case SAJT = 'Sajt';
    case TARTOS_TEJTERMEK = HozzavaloKategoria::TARTOS_TEJTERMEK->value;
    case TEJTERMEK = HozzavaloKategoria::TEJTERMEK->value;
    case HUS = HozzavaloKategoria::HUS->value;
    case FELVAGOTT = HozzavaloKategoria::FELVAGOTT->value;
    case JOGHURT = 'Joghurt';
    case ZOLDSEG_GYUMOLCS = HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value;
    case HAL = 'Hal';
    case PEKARU = HozzavaloKategoria::PEKARU->value;

    public function value(): string
    {
        return $this->value;
    }
}
