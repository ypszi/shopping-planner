<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Felvagott\Felvagott;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Ketchup;
use PeterPecosz\Kajatervezo\Hozzavalo\Sajt\MozzarellaSajtReszelt;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Pizza extends Etel
{
    private Pizzateszta $pizzateszta;

    public function __construct(?int $adag = null)
    {
        $this->pizzateszta = new Pizzateszta($adag);

        parent::__construct($adag);
    }

    public static function name(): string
    {
        return 'Pizza';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Felvagott(15, Mertekegyseg::DKG),
            new MozzarellaSajtReszelt(150, Mertekegyseg::G),
            new Ketchup(50, Mertekegyseg::G),
            ...$this->pizzateszta->hozzavalok(),
        ];
    }

    public static function defaultAdag(): int
    {
        return Pizzateszta::defaultAdag();
    }

    public function rawReceptUrl(): string
    {
        return $this->pizzateszta->receptUrl();
    }
}
