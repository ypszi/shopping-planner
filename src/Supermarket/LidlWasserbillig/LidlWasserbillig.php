<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig;

use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class LidlWasserbillig extends Supermarket
{
    public static function name(): string
    {
        return 'Lidl - Wasserbillig';
    }

    public static function sorrend(): array
    {
        return [
            LidlWasserbilligKategoria::MUZLI_PEKARU->value,
            LidlWasserbilligKategoria::ZOLDSEG_GYUMOLCS->value,
            LidlWasserbilligKategoria::KAVE_TEA_KEKSZ->value,
            LidlWasserbilligKategoria::FELVAGOTT->value,
            LidlWasserbilligKategoria::HUS->value,
            LidlWasserbilligKategoria::FUSZER_HAL->value,
            LidlWasserbilligKategoria::SAJT->value,
            LidlWasserbilligKategoria::TEJTERMEK->value,
            LidlWasserbilligKategoria::UDITO->value,
            LidlWasserbilligKategoria::MIRELIT->value,
            LidlWasserbilligKategoria::SOS_RAGCSA_SOR_BOR->value,
            LidlWasserbilligKategoria::TARTOS_ELELMISZER->value,
        ];
    }
}
