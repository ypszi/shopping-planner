<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class TescoFogarasiKategoriaMap extends KategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::UDITO->value             => TescoFogarasiKategoria::UDITO,
            HozzavaloKategoria::BOR->value               => TescoFogarasiKategoria::UDITO,
            HozzavaloKategoria::OLAJ->value              => TescoFogarasiKategoria::OLAJ_ECET,
            HozzavaloKategoria::ECET->value              => TescoFogarasiKategoria::OLAJ_ECET,
            HozzavaloKategoria::FUSZER->value            => TescoFogarasiKategoria::FUSZER,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => TescoFogarasiKategoria::TESZTA_RIZS,
            HozzavaloKategoria::CUKRASZ->value           => TescoFogarasiKategoria::CUKOR_LISZT_SUTEMENY,
            HozzavaloKategoria::AZSIAI->value            => TescoFogarasiKategoria::TESZTA_RIZS,
            HozzavaloKategoria::MIRELIT->value           => TescoFogarasiKategoria::MIRELIT,
            HozzavaloKategoria::SAJT->value              => TescoFogarasiKategoria::SAJT,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => TescoFogarasiKategoria::TARTOS_TEJTERMEK,
            HozzavaloKategoria::TEJTERMEK->value         => TescoFogarasiKategoria::TEJTERMEK,
            HozzavaloKategoria::HUS->value               => TescoFogarasiKategoria::HUS,
            HozzavaloKategoria::FELVAGOTT->value         => TescoFogarasiKategoria::FELVAGOTT,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => TescoFogarasiKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::HAL->value               => TescoFogarasiKategoria::MIRELIT,
            HozzavaloKategoria::PEKARU->value            => TescoFogarasiKategoria::PEKARU,
        ];
    }
}
