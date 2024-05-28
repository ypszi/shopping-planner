<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig;

use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class MatchWasserbillig extends Supermarket
{
    public static function name(): string
    {
        return 'Match - Wasserbillig';
    }

    public static function sorrend(): array
    {
        return [
            MatchWasserbilligKategoria::PEKARU->value,
            MatchWasserbilligKategoria::ZOLDSEG_GYUMOLCS->value,
            MatchWasserbilligKategoria::KAVE_TEA->value,
            MatchWasserbilligKategoria::BOR->value,
            MatchWasserbilligKategoria::TARTOS_TEJTERMEK->value,
            MatchWasserbilligKategoria::TEJTERMEK->value,
            MatchWasserbilligKategoria::SAJT->value,
            MatchWasserbilligKategoria::HUS->value,
            MatchWasserbilligKategoria::HAL->value,
            MatchWasserbilligKategoria::MIRELIT->value,
            MatchWasserbilligKategoria::FELVAGOTT->value,
            MatchWasserbilligKategoria::RIZS_TESZTA->value,
            MatchWasserbilligKategoria::FUSZER->value,
            MatchWasserbilligKategoria::AZSIAI->value,
            MatchWasserbilligKategoria::OLAJ_ECET->value,
            MatchWasserbilligKategoria::KONZERV->value,
            MatchWasserbilligKategoria::UDITO->value,
        ];
    }
}
