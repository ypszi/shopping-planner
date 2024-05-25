<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Fuszerkomeny;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\GulyasKrem;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Sertescomb;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\HegyesPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Paradicsom;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Porkolt extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Pörkölt';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new Sertescomb(1, Mertekegyseg::KG),
            new Voroshagyma(4, Mertekegyseg::DB),
            new Fokhagyma(4, Mertekegyseg::GEREZD),
            new Paradicsom(2, Mertekegyseg::DB),
            new Paprika(2, Mertekegyseg::DB),
            new HegyesPaprika(1, Mertekegyseg::DB),
            new OlivaOlaj(6, Mertekegyseg::EK),
            new Fuszerkomeny(1, Mertekegyseg::KVK),
            new So(1, Mertekegyseg::TK),
            new GulyasKrem(1, Mertekegyseg::TK),
            new PirosPaprika(1, Mertekegyseg::EK),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[Override] public function receptUrl(): string
    {
        return 'https://www.mindmegette.hu/klasszikus-sertesporkolt.recept/';
    }
}
