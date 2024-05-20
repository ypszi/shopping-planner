<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\KolozsvariSzalonna;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paradicsom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Lecso extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Lecsó';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Paradicsom(40, Mertekegyseg::DKG),
            new Paprika(80, Mertekegyseg::DKG),
            new Voroshagyma(2, Mertekegyseg::DB),
            new KolozsvariSzalonna(5, Mertekegyseg::DKG),
            new NapraforgoOlaj(2, Mertekegyseg::EK),
            new PirosPaprika(1, Mertekegyseg::EK),
            new So(1, Mertekegyseg::TK),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/lecso.recept/';
    }
}
