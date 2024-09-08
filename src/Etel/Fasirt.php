<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Majoranna;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Petrezselyem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\DaraltHus;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Zsemlemorzsa;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Fasirt extends Etel
{
    public static function name(): string
    {
        return 'Fasírt';
    }

    protected function listHozzavalok(): array
    {
        return [
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new DaraltHus(500, Mertekegyseg::G),
            new Tojas(2, Mertekegyseg::DB),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::MK),
            new Majoranna(1, Mertekegyseg::TK),
            new FuszerPaprika(1, Mertekegyseg::TK),
            new Petrezselyem(1, Mertekegyseg::EK),
            new Zsemlemorzsa(100, Mertekegyseg::G),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return 'https://www.nosalty.hu/recept/harapnivalo-fasirt';
    }

    public function thumbnailUrl(): string
    {
        return 'https://image-api.nosalty.hu/nosalty/images/recipes/rD/RF/harapnivalo-fasirt.jpeg?w=540&fit=crop&fm=webp&crop=1799%2C1028%2C59%2C31&h=270&s=2e8f1db44c5d4815f6ffa03729601e67';
    }
}
