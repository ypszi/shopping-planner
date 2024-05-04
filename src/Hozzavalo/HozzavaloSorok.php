<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

class HozzavaloSorok
{
    /** @var HozzavaloSor[] */
    private array $hozzavaloSorok;

    /**
     * @param HozzavaloSor[] $hozzavaloSorok
     */
    public function __construct(array $hozzavaloSorok = [])
    {
        $this->hozzavaloSorok = $hozzavaloSorok;
    }

    public function add(HozzavaloSor $hozzavaloSor): self
    {
        $this->hozzavaloSorok[] = $hozzavaloSor;

        return $this;
    }

    /**
     * @return array<string[]>
     */
    public function toArray(): array
    {
        return array_map(fn(HozzavaloSor $hozzavaloSor) => $hozzavaloSor->toArray(), $this->hozzavaloSorok);
    }

    public function sort(): self
    {
        $sortedHozzavalok = $this->sortHozzavalok();
        $hozzavaloSorok   = new self();

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

                return;
            }
        }

        $nextHozzavaloSor = new HozzavaloSor();
        $nextHozzavaloSor->add($hozzavalo);
        $this->add($nextHozzavaloSor);
    }

    /**
     * @return array<string, Hozzavalo[]>
     */
    private function sortHozzavalok(): array
    {
        $orderedHozzavalok = [];
        foreach ($this->hozzavaloSorok as $hozzavaloSor) {
            foreach ($hozzavaloSor->getHozzavalokPerKategoria() as $kategoria => $hozzavalo) {
                $orderedHozzavalok[$kategoria][] = $hozzavalo;
            }
        }

        foreach ($orderedHozzavalok as &$orderedHozzavalo) {
            usort($orderedHozzavalo, function (Hozzavalo $hozzavalo1, Hozzavalo $hozzavalo2) {
                return strnatcmp($hozzavalo1::name(), $hozzavalo2::name());
            });
        }

        return $orderedHozzavalok;
    }
}
