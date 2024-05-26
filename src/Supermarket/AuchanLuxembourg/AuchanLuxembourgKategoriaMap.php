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
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => AuchanLuxembourgKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::OLAJ->value              => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            HozzavaloKategoria::ECET->value              => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            HozzavaloKategoria::FUSZER->value            => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER,
            HozzavaloKategoria::BOR->value               => AuchanLuxembourgKategoria::UDITO,
            HozzavaloKategoria::PEKARU->value            => AuchanLuxembourgKategoria::PEKARU,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => AuchanLuxembourgKategoria::TESZTA_RIZS_PARADICSOMSZOSZ_PURE,
            HozzavaloKategoria::CUKRASZ->value           => AuchanLuxembourgKategoria::CUKRASZ_KEKSZ,
            HozzavaloKategoria::FELVAGOTT->value         => AuchanLuxembourgKategoria::FELVAGOTT,
            HozzavaloKategoria::HUS->value               => AuchanLuxembourgKategoria::HUS,
            HozzavaloKategoria::MIRELIT->value           => AuchanLuxembourgKategoria::MIRELIT,
            HozzavaloKategoria::TEJTERMEK->value         => AuchanLuxembourgKategoria::TEJTERMEK,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => AuchanLuxembourgKategoria::TARTOS_TEJTERMEK,
            HozzavaloKategoria::AZSIAI->value            => AuchanLuxembourgKategoria::NEMZETKOZI,
            HozzavaloKategoria::UDITO->value             => AuchanLuxembourgKategoria::UDITO,
        ];
    }
}
