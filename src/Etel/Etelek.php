<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSor;
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
            foreach ($etel->getHozzavalok() as $hozzavalo) {
                $this->addHozzavalo($hozzavaloSorok, $hozzavalo);
            }
        }

        return $hozzavaloSorok;
    }

    /**
     * @return Etel[]
     */
    public function toArray(): array
    {
        return $this->etelek;
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
