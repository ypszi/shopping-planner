<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use Override;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class AuchanLuxembourg extends Supermarket
{
    public static function name(): string
    {
        return 'Auchan - Luxembourg';
    }

    /**
     * @return string[]
     */
    #[Override] public static function sorrend(): array
    {
        return [
            AuchanLuxembourgKategoria::UDITO->value,
            AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER->value,
            AuchanLuxembourgKategoria::TESZTA_RIZS_PARADICSOMSZOSZ_PURE->value,
            AuchanLuxembourgKategoria::TEA_KAVE->value,
            AuchanLuxembourgKategoria::CUKRASZ_KEKSZ->value,
            AuchanLuxembourgKategoria::NEMZETKOZI->value,
            AuchanLuxembourgKategoria::MIRELIT->value,
            AuchanLuxembourgKategoria::SAJT->value,
            AuchanLuxembourgKategoria::TARTOS_TEJTERMEK->value,
            AuchanLuxembourgKategoria::TEJTERMEK->value,
            AuchanLuxembourgKategoria::HUS->value,
            AuchanLuxembourgKategoria::FELVAGOTT->value,
            AuchanLuxembourgKategoria::JOGHURT->value,
            AuchanLuxembourgKategoria::ZOLDSEG_GYUMOLCS->value,
            AuchanLuxembourgKategoria::HAL->value,
            AuchanLuxembourgKategoria::PEKARU->value,
        ];
    }
}
