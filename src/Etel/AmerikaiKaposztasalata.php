<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Majonez;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Mustar;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Lilakaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class AmerikaiKaposztasalata extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Amerikai káposztasaláta';
    }

    #[Override] protected static function listHozzavalok(): array
    {
        return [
            new Sargarepa(1, Mertekegyseg::DB),
            new Lilakaposzta(0.5, Mertekegyseg::DB),
            new Kaposzta(1, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Tejfol(4, Mertekegyseg::EK),
            new Majonez(2, Mertekegyseg::EK),
            new Mustar(1, Mertekegyseg::TK),
            new Citrom(1, Mertekegyseg::DB),
            new So(2, Mertekegyseg::CSIPET),
            new Bors(2, Mertekegyseg::CSIPET),
            new Cukor(2, Mertekegyseg::KVK),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 8;
    }

    #[Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/amerikai-kaposztasalata-a-coleslaw-salata.recept/';
    }
}
