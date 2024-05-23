<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\DaraltHus;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Zsemlemorzsa;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Fasirt extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Fasírt';
    }

    #[Override] protected static function listHozzavalok(): array
    {
        return [
            new DaraltHus(1, Mertekegyseg::KG),
            new Tojas(2, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            // 1 fej fokhagyma recept szerint
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::MK),
            // annyi zsemlemorzsát adunk hozzá, hogy golyókat tudjunk belőle formálni
            new Zsemlemorzsa(50, Mertekegyseg::G),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/fasirt-sutoben-sutve.recept/';
    }
}
