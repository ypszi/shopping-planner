<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class AuchanCsomor extends Supermarket
{
    public static function name(): string
    {
        return 'Auchan - Csömör';
    }

    /**
     * @return string[]
     */
    public static function sorrend(): array
    {
        return [
            AuchanCsomorKategoria::ZOLDSEG_GYUMOLCS->value,
            AuchanCsomorKategoria::HAL->value,
            AuchanCsomorKategoria::PEKARU->value,
            AuchanCsomorKategoria::MIRELIT->value,
            AuchanCsomorKategoria::TEJTERMEK->value,
            AuchanCsomorKategoria::TARTOS_TEJTERMEK->value,
            AuchanCsomorKategoria::HUS->value,
            AuchanCsomorKategoria::FELVAGOTT->value,
            AuchanCsomorKategoria::SUTEMENY->value,
            AuchanCsomorKategoria::UDITO->value,
            AuchanCsomorKategoria::NEMZETKOZI->value,
            AuchanCsomorKategoria::OLAJ_ECET->value,
            AuchanCsomorKategoria::FUSZER->value,
            AuchanCsomorKategoria::KONZERV->value,
            AuchanCsomorKategoria::TESZTA_RIZS->value,
        ];
    }
}
