<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;

class Etelek
{
    /** @var Etel[] */
    private array $etelek;

    public function __construct(array $etelek = [])
    {
        $this->etelek = $etelek;
    }

    public function add(Etel $etel): self
    {
        $this->etelek[] = $etel;

        return $this;
    }

    public function createHozzavaloSorok(): HozzavaloSorok
    {
        $hozzavaloSorok = new HozzavaloSorok();

        foreach ($this->etelek as $etel) {
            foreach ($etel->hozzavalok() as $hozzavalo) {
                $hozzavaloSorok->addHozzavalo($hozzavalo);
            }
        }

        return $hozzavaloSorok->sort();
    }

    /**
     * @return Etel[]
     */
    public function toArray(): array
    {
        return $this->etelek;
    }
}
