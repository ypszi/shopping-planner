<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class LidlWasserbilligKategoriaMap extends KategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::PEKARU->value            => LidlWasserbilligKategoria::MUZLI_PEKARU,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => LidlWasserbilligKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::FELVAGOTT->value         => LidlWasserbilligKategoria::FELVAGOTT,
            HozzavaloKategoria::HUS->value               => LidlWasserbilligKategoria::HUS,
            HozzavaloKategoria::HAL->value               => LidlWasserbilligKategoria::FUSZER_HAL,
            HozzavaloKategoria::FUSZER->value            => LidlWasserbilligKategoria::FUSZER_HAL,
            HozzavaloKategoria::SAJT->value              => LidlWasserbilligKategoria::SAJT,
            HozzavaloKategoria::TEJTERMEK->value         => LidlWasserbilligKategoria::TEJTERMEK,
            HozzavaloKategoria::UDITO->value             => LidlWasserbilligKategoria::UDITO,
            HozzavaloKategoria::MIRELIT->value           => LidlWasserbilligKategoria::MIRELIT,
            HozzavaloKategoria::BOR->value               => LidlWasserbilligKategoria::SOS_RAGCSA_SOR_BOR,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            HozzavaloKategoria::OLAJ->value              => LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            HozzavaloKategoria::ECET->value              => LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            HozzavaloKategoria::CUKRASZ->value           => LidlWasserbilligKategoria::TARTOS_ELELMISZER,
            HozzavaloKategoria::AZSIAI->value            => LidlWasserbilligKategoria::TARTOS_ELELMISZER,
        ];
    }
}
