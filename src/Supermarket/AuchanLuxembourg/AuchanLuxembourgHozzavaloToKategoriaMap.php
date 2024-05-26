<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\TonhalKonzerv;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\FetaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\GoudaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\MozzarellaSajtReszelt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\TrappistaSajt;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;

class AuchanLuxembourgHozzavaloToKategoriaMap extends HozzavaloToKategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    #[Override] protected function hozzavaloMap(): array
    {
        return [
            FetaSajt::name()              => AuchanLuxembourgKategoria::SAJT,
            GoudaSajt::name()             => AuchanLuxembourgKategoria::SAJT,
            MozzarellaSajt::name()        => AuchanLuxembourgKategoria::SAJT,
            MozzarellaSajtReszelt::name() => AuchanLuxembourgKategoria::SAJT,
            ParmezanSajt::name()          => AuchanLuxembourgKategoria::SAJT,
            Tojas::name()                 => HozzavaloKategoria::TARTOS_TEJTERMEK,
            TonhalKonzerv::name()         => AuchanLuxembourgKategoria::NEMZETKOZI,
            TrappistaSajt::name()         => AuchanLuxembourgKategoria::SAJT,
        ];
    }
}
