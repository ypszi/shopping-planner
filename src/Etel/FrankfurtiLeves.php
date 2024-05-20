<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Komenymag;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Serteszsir;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Virsli;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Burgonya;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kelkaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class FrankfurtiLeves extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Frankfurti leves';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Serteszsir(1, Mertekegyseg::EK),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Fuszerpaprika(1, Mertekegyseg::EK),
            new Komenymag(1, Mertekegyseg::TK),
            new Burgonya(4, Mertekegyseg::DB),
            new Kelkaposzta(1, Mertekegyseg::DB),
            new Virsli(10, Mertekegyseg::DKG),
            new So(1, Mertekegyseg::TK),
            new Bors(1, Mertekegyseg::MK),
            new Tejfol(175, Mertekegyseg::G),
            new Finomliszt(1, Mertekegyseg::EK),
            // 2 l víz
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 8;
    }

    #[\Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/frankfurti-leves-egyszeruen');
    }
}
