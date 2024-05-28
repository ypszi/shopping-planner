<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class AuchanLuxembourgKategoriaMap extends KategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::UDITO->value             => AuchanLuxembourgKategoria::UDITO,
            HozzavaloKategoria::BOR->value               => AuchanLuxembourgKategoria::UDITO,
            HozzavaloKategoria::OLAJ->value              => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            HozzavaloKategoria::ECET->value              => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            HozzavaloKategoria::FUSZER->value            => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => AuchanLuxembourgKategoria::TESZTA_RIZS_PARADICSOMSZOSZ_PURE,
            HozzavaloKategoria::CUKRASZ->value           => AuchanLuxembourgKategoria::CUKRASZ_KEKSZ,
            HozzavaloKategoria::AZSIAI->value            => AuchanLuxembourgKategoria::NEMZETKOZI,
            HozzavaloKategoria::MIRELIT->value           => AuchanLuxembourgKategoria::MIRELIT,
            HozzavaloKategoria::SAJT->value              => AuchanLuxembourgKategoria::SAJT,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => AuchanLuxembourgKategoria::TARTOS_TEJTERMEK,
            HozzavaloKategoria::TEJTERMEK->value         => AuchanLuxembourgKategoria::TEJTERMEK,
            HozzavaloKategoria::HUS->value               => AuchanLuxembourgKategoria::HUS,
            HozzavaloKategoria::FELVAGOTT->value         => AuchanLuxembourgKategoria::FELVAGOTT,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => AuchanLuxembourgKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::HAL->value               => AuchanLuxembourgKategoria::HAL,
            HozzavaloKategoria::PEKARU->value            => AuchanLuxembourgKategoria::PEKARU,
        ];
    }
}
