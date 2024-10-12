<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class AuchanCsomorKategoriaMap extends KategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::UDITO->value             => AuchanCsomorKategoria::UDITO,
            HozzavaloKategoria::BOR->value               => AuchanCsomorKategoria::UDITO,
            HozzavaloKategoria::OLAJ->value              => AuchanCsomorKategoria::OLAJ_ECET,
            HozzavaloKategoria::ECET->value              => AuchanCsomorKategoria::OLAJ_ECET,
            HozzavaloKategoria::FUSZER->value            => AuchanCsomorKategoria::FUSZER,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => AuchanCsomorKategoria::TESZTA_RIZS,
            HozzavaloKategoria::CUKRASZ->value           => AuchanCsomorKategoria::SUTEMENY,
            HozzavaloKategoria::AZSIAI->value            => AuchanCsomorKategoria::NEMZETKOZI,
            HozzavaloKategoria::MIRELIT->value           => AuchanCsomorKategoria::MIRELIT,
            HozzavaloKategoria::SAJT->value              => AuchanCsomorKategoria::TEJTERMEK,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => AuchanCsomorKategoria::TARTOS_TEJTERMEK,
            HozzavaloKategoria::TEJTERMEK->value         => AuchanCsomorKategoria::TEJTERMEK,
            HozzavaloKategoria::HUS->value               => AuchanCsomorKategoria::HUS,
            HozzavaloKategoria::FELVAGOTT->value         => AuchanCsomorKategoria::FELVAGOTT,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => AuchanCsomorKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::HAL->value               => AuchanCsomorKategoria::HAL,
            HozzavaloKategoria::PEKARU->value            => AuchanCsomorKategoria::PEKARU,
        ];
    }
}
