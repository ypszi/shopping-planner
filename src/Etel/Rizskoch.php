<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Baracklekvar;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Porcukor;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\Rizs;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\VaniliasCukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Citrom;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Rizskoch extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Rizskoch';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Citrom(0.5, Mertekegyseg::DB),
            new Rizs(250, Mertekegyseg::G),
            new VaniliasCukor(250, Mertekegyseg::G),
            new Cukor(130, Mertekegyseg::G),
            // porcukor ízlés szerint
            new Porcukor(100, Mertekegyseg::G),
            // baracklekvár ízlés szerint
            new Baracklekvar(150, Mertekegyseg::G),
            new Tojas(5, Mertekegyseg::DB),
            new Tej(8, Mertekegyseg::DL),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://streetkitchen.hu/meguszos-sutik/rizskoch-baracklekvarral/';
    }
}
