<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi;

use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class TescoFogarasi extends Supermarket
{
    public static function name(): string
    {
        return 'Tesco - Fogarasi';
    }

    /**
     * @return string[]
     */
    public static function sorrend(): array
    {
        return [
            TescoFogarasiKategoria::ZOLDSEG_GYUMOLCS->value,
            TescoFogarasiKategoria::PEKARU->value,
            TescoFogarasiKategoria::FELVAGOTT->value,
            TescoFogarasiKategoria::SAJT->value,
            TescoFogarasiKategoria::TEJTERMEK->value,
            TescoFogarasiKategoria::HUS->value,
            TescoFogarasiKategoria::TARTOS_TEJTERMEK->value,
            TescoFogarasiKategoria::TESZTA_RIZS->value,
            TescoFogarasiKategoria::MIRELIT->value,
            TescoFogarasiKategoria::OLAJ_ECET->value,
            TescoFogarasiKategoria::KONZERV->value,
            TescoFogarasiKategoria::FUSZER->value,
            TescoFogarasiKategoria::CUKOR_LISZT_SUTEMENY->value,
            TescoFogarasiKategoria::MOGYORO_CHIPS_SNACKS->value,
            TescoFogarasiKategoria::EDESSEG_KEKSZ->value,
            TescoFogarasiKategoria::UDITO->value,
        ];
    }
}
