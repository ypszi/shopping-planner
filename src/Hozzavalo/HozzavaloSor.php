<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

class HozzavaloSor
{
    /** @var array<string, Hozzavalo> */
    private array $hozzavalokPerKategoria;

    /**
     * @param array<Hozzavalo> $hozzavalok
     */
    public function __construct(array $hozzavalok = [])
    {
        $this->hozzavalokPerKategoria = [];

        foreach ($hozzavalok as $hozzavalo) {
            $this->add($hozzavalo);
        }
    }

    public function add(Hozzavalo $hozzavalo): self
    {
        $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] = $hozzavalo;

        $this->sort();

        return $this;
    }

    public function canAdd(Hozzavalo $hozzavalo): bool
    {
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] ?? null;

        return empty($hozzaadottHozzavalo);
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        $sor = [];
        foreach (HozzavaloKategoria::SORREND as $kategoria) {
            $hozzavalo = $this->hozzavalokPerKategoria[$kategoria] ?? null;
            $sor[]     = $hozzavalo ? (string)$hozzavalo : '';
        }

        return $sor;
    }

    private function sort(): self
    {
        uksort(
            $this->hozzavalokPerKategoria,
            fn(string $hozzavaloKategoria1, string $hozzavaloKategoria2) => array_search($hozzavaloKategoria1, HozzavaloKategoria::SORREND) <=> array_search($hozzavaloKategoria2, HozzavaloKategoria::SORREND)
        );

        return $this;
    }
}
