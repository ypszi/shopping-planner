<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\DaraltHus;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Udito\Szodaviz;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paradicsom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class HortobagyiPalacsinta extends Etel
{
    public static function name(): string
    {
        return 'Hortobágyi Palacsinta';
    }

    protected function listHozzavalok(): array
    {
        return [
            // A töltelékhez:
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(1, Mertekegyseg::GEREZD),
            new NapraforgoOlaj(1, Mertekegyseg::EK),
            new DaraltHus(50, Mertekegyseg::DKG),
            new Paprika(1, Mertekegyseg::DB),
            new Paradicsom(1, Mertekegyseg::DB),
            new So(1, Mertekegyseg::MK),
            new Bors(0.5, Mertekegyseg::MK),
            new PirosPaprika(1, Mertekegyseg::MK),
            new Tejfol(400, Mertekegyseg::G),
            // A palacsintatésztához:
            new Finomliszt(20, Mertekegyseg::DKG),
            new Szodaviz(2, Mertekegyseg::DL),
            new Tej(2, Mertekegyseg::DL),
            new Tojas(2, Mertekegyseg::DB),
            new So(1, Mertekegyseg::CSIPET),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.mindmegette.hu/hortobagyi-husos-palacsinta-ii.recept/';
    }

    public function thumbnailUrl(): string
    {
        return 'https://www.mindmegette.hu/images/379/Social/lead_Social_hortobagyi-husos-palacsinta-recept.jpg';
    }
}
