<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class MatchWasserbilligKategoriaMap extends KategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::PEKARU->value            => MatchWasserbilligKategoria::PEKARU,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => MatchWasserbilligKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::FELVAGOTT->value         => MatchWasserbilligKategoria::FELVAGOTT,
            HozzavaloKategoria::HUS->value               => MatchWasserbilligKategoria::HUS,
            HozzavaloKategoria::HAL->value               => MatchWasserbilligKategoria::HAL,
            HozzavaloKategoria::FUSZER->value            => MatchWasserbilligKategoria::FUSZER,
            HozzavaloKategoria::SAJT->value              => MatchWasserbilligKategoria::SAJT,
            HozzavaloKategoria::TEJTERMEK->value         => MatchWasserbilligKategoria::TEJTERMEK,
            HozzavaloKategoria::UDITO->value             => MatchWasserbilligKategoria::UDITO,
            HozzavaloKategoria::MIRELIT->value           => MatchWasserbilligKategoria::MIRELIT,
            HozzavaloKategoria::BOR->value               => MatchWasserbilligKategoria::BOR,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => MatchWasserbilligKategoria::TARTOS_TEJTERMEK,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => MatchWasserbilligKategoria::RIZS_TESZTA,
            HozzavaloKategoria::OLAJ->value              => MatchWasserbilligKategoria::OLAJ_ECET,
            HozzavaloKategoria::ECET->value              => MatchWasserbilligKategoria::OLAJ_ECET,
            HozzavaloKategoria::CUKRASZ->value           => MatchWasserbilligKategoria::RIZS_TESZTA,
            HozzavaloKategoria::AZSIAI->value            => MatchWasserbilligKategoria::AZSIAI,
        ];
    }
}
