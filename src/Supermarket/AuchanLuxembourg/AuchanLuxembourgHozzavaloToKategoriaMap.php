<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
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

class AuchanLuxembourgHozzavaloToKategoriaMap implements HozzavaloToKategoriaMap
{
    #[Override] public function map(Hozzavalo $hozzavalo): Kategoria
    {
        $mappedKategoria = $this->hozzavaloMap()[$hozzavalo::name()] ?? null;

        if (!$mappedKategoria) {
            return $hozzavalo->kategoria();
        }

        return AuchanLuxembourgKategoria::from($mappedKategoria);
    }

    /**
     * @return array<string, string>
     */
    private function hozzavaloMap(): array
    {
        return [
            FetaSajt::name()              => AuchanLuxembourgKategoria::SAJT->value,
            GoudaSajt::name()             => AuchanLuxembourgKategoria::SAJT->value,
            MozzarellaSajt::name()        => AuchanLuxembourgKategoria::SAJT->value,
            MozzarellaSajtReszelt::name() => AuchanLuxembourgKategoria::SAJT->value,
            ParmezanSajt::name()          => AuchanLuxembourgKategoria::SAJT->value,
            Tojas::name()                 => HozzavaloKategoria::TARTOS_TEJTERMEK->value,
            TonhalKonzerv::name()         => AuchanLuxembourgKategoria::NEMZETKOZI->value,
            TrappistaSajt::name()         => AuchanLuxembourgKategoria::SAJT->value,
        ];
    }
}
