<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Fuszerkeverek;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Kakukkfu;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Majoranna;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Mustar;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Oregano;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Rozmaring;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\DaraltHus;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\MozzarellaSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Liszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Fozotejszin;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Udito\Szodaviz;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class GorogosHusosPalacsinta extends Etel
{
    public static function name(): string
    {
        return 'Görögös húsos palacsinta';
    }

    protected function listHozzavalok(): array
    {
        return [
            // A palacsintához
            new Liszt(20, Mertekegyseg::DKG),
            new Tojas(2, Mertekegyseg::DB),
            new Szodaviz(2, Mertekegyseg::DL),
            new Tej(2, Mertekegyseg::DL),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(2, Mertekegyseg::CSIPET),
            new Kakukkfu(1, Mertekegyseg::MK),
            // A töltelékhez
            new DaraltHus(500, Mertekegyseg::G),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new Fozotejszin(3, Mertekegyseg::DL),
            new Mustar(1, Mertekegyseg::EK),
            new So(1, Mertekegyseg::KK),
            new Bors(1, Mertekegyseg::KK),
            new Kakukkfu(1, Mertekegyseg::KK),
            new Oregano(1, Mertekegyseg::KK),
            new Majoranna(1, Mertekegyseg::KK),
            // fűszerkeverék vagy fűszerpaprika
            new Fuszerkeverek(1, Mertekegyseg::KK),
            new Rozmaring(1, Mertekegyseg::KK),
            new Cukor(1, Mertekegyseg::CSIPET),
            // A tetejére
            new Tejfol(175, Mertekegyseg::G),
            new MozzarellaSajt(10, Mertekegyseg::DKG),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/gorogos-husos-palacsinta';
    }
}
