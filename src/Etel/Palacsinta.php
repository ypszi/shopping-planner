<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\VaniliasCukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosTejtermek\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Udito\Szodaviz;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Palacsinta extends Etel
{
    public static function name(): string
    {
        return 'Palacsinta';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Tojas(3, Mertekegyseg::DB),
            new Cukor(2, Mertekegyseg::EK),
            new VaniliasCukor(2, Mertekegyseg::G),
            new Finomliszt(240, Mertekegyseg::G),
            new Tej(2.5, Mertekegyseg::DL),
            new Szodaviz(2.5, Mertekegyseg::DL),
            new NapraforgoOlaj(0.5, Mertekegyseg::DL),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/palacsinta-alaprecept');
    }
}
