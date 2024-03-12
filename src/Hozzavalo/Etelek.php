<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Etel\Etel;

class Etelek
{
    /** @var Etel[] */
    private array $etelek;

    public function __construct(array $etelek)
    {
        $this->etelek = $etelek;
    }

    public function createHozzavaloSorok(): HozzavaloSorok
    {
        $hozzavaloSorok = new HozzavaloSorok();

        foreach ($this->etelek as $etel) {
            foreach ($etel->getHozzavalok() as $hozzavalo) {
                $this->addHozzavalo($hozzavaloSorok, $hozzavalo);
            }
        }

        return $hozzavaloSorok;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return array_map(fn(Etel $etel) => $etel::getName(), $this->etelek);
    }

    private function addHozzavalo(HozzavaloSorok $hozzavaloSorok, Hozzavalo $hozzavalo): void
    {
        foreach ($hozzavaloSorok->getAll() as $hozzavaloSor) {
            if ($hozzavaloSor->canAdd($hozzavalo)) {
                $hozzavaloSor->add($hozzavalo);

                return;
            }
        }

        $nextHozzavaloSor = new HozzavaloSor();
        $nextHozzavaloSor->add($hozzavalo);
        $hozzavaloSorok->add($nextHozzavaloSor);
    }
}
