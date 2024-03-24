<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\CayenneBors;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\GyomberPor;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj\Zoldfuszer;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class BundasCsirke extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Bundás csirke';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Fokhagyma(3, Mertekegyseg::GEREZD),
            new NapraforgoOlaj(2, Mertekegyseg::DL),
            new GyomberPor(1.5, Mertekegyseg::TK),
            new Szerecsendio(1, Mertekegyseg::TK),
            new FuszerPaprika(1, Mertekegyseg::TK),
            new Zoldfuszer(1, Mertekegyseg::TK),
            new CayenneBors(0.5, Mertekegyseg::TK),
            new OlivaOlaj(2, Mertekegyseg::EK),
            new Hozzavalo(Hozzavalo::FINOMLISZT, 1, Mertekegyseg::BOGRE),
            new Hozzavalo(Hozzavalo::MEZ, 50, Mertekegyseg::ML),
            new Hozzavalo(Hozzavalo::SZOJASZOSZ, 50, Mertekegyseg::ML),
            new Hozzavalo(Hozzavalo::CSIRKEMELL, 4, Mertekegyseg::DB),
            new Hozzavalo(Hozzavalo::TOJAS, 3, Mertekegyseg::DB),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return sprintf('https://www.nosalty.hu/recept/puha-ropogos-fokhagymas-mezes-csirkemell?adag=%d', $this->adag);
    }
}
