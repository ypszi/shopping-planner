<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class HozzavaloSorok
{
    private Supermarket $supermarket;

    /** @var HozzavaloSor[] */
    private array $hozzavaloSorok;

    public function __construct(Supermarket $supermarket)
    {
        $this->supermarket    = $supermarket;
        $this->hozzavaloSorok = [];
    }

    public function add(HozzavaloSor $hozzavaloSor): self
    {
        $this->hozzavaloSorok[] = $hozzavaloSor;

        return $this;
    }

    /**
     * @return string[][]
     */
    public function toArray(): array
    {
        return array_map(fn(HozzavaloSor $hozzavaloSor) => $hozzavaloSor->toArray($this->supermarket), $this->hozzavaloSorok);
    }

    public function sort(): self
    {
        $sortedHozzavalok = $this->sortHozzavalok();
        $hozzavaloSorok   = new self($this->supermarket);

        foreach ($sortedHozzavalok as $hozzavalok) {
            foreach ($hozzavalok as $hozzavalo) {
                $hozzavaloSorok->addHozzavalo($hozzavalo);
            }
        }

        $this->hozzavaloSorok = $hozzavaloSorok->hozzavaloSorok;

        return $this;
    }

    public function addHozzavalo(Hozzavalo $hozzavalo): void
    {
        foreach ($this->hozzavaloSorok as $hozzavaloSor) {
            if ($hozzavaloSor->canAdd($hozzavalo)) {
                $hozzavaloSor->add($hozzavalo);
                $hozzavaloSor->sort($this->supermarket::sorrend());

                return;
            }
        }

        $nextHozzavaloSor = new HozzavaloSor();
        $nextHozzavaloSor->add($hozzavalo);
        $nextHozzavaloSor->sort($this->supermarket::sorrend());

        $this->add($nextHozzavaloSor);
    }

    /**
     * @return array<string, Hozzavalo[]>
     */
    private function sortHozzavalok(): array
    {
        return $this->sortByName($this->sortByMertekegyseg($this->groupHozzavalokByKategoria()));
    }

    /**
     * @return array<string, Hozzavalo[]>
     */
    private function groupHozzavalokByKategoria(): array
    {
        $hozzavalokByKategoria = [];
        foreach ($this->hozzavaloSorok as $hozzavaloSor) {
            foreach ($hozzavaloSor->getHozzavalokPerKategoria() as $kategoria => $hozzavalo) {
                $hozzavalokByKategoria[$kategoria][] = $hozzavalo;
            }
        }

        return $hozzavalokByKategoria;
    }

    /**
     * @param array<string, Hozzavalo[]> $hozzavalokByKategoria
     *
     * @return array<string, Hozzavalo[]>
     */
    private function sortByMertekegyseg(array $hozzavalokByKategoria): array
    {
        foreach ($hozzavalokByKategoria as &$hozzavalok) {
            usort($hozzavalok, function (Hozzavalo $hozzavalo1, Hozzavalo $hozzavalo2) {
                return strnatcmp($hozzavalo1->getMertekegyseg()->value, $hozzavalo2->getMertekegyseg()->value);
            });
        }

        return $hozzavalokByKategoria;
    }

    /**
     * @param array<string, Hozzavalo[]> $hozzavalokByKategoria
     *
     * @return array<string, Hozzavalo[]>
     */
    private function sortByName(array $hozzavalokByKategoria): array
    {
        foreach ($hozzavalokByKategoria as &$hozzavalok) {
            usort($hozzavalok, function (Hozzavalo $hozzavalo1, Hozzavalo $hozzavalo2) {
                return strnatcmp($hozzavalo1->name(), $hozzavalo2->name());
            });
        }

        return $hozzavalokByKategoria;
    }
}
