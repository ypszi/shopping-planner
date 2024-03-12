<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Mertekegyseg\MertekegysegAtvalto;

class HozzavaloSor
{
    private MertekegysegAtvalto $mertekegysegAtvalto;

    /** @var array<string, Hozzavalo> */
    private array $hozzavalokPerKategoria;

    /**
     * @param array<Hozzavalo> $hozzavalok
     */
    public function __construct(array $hozzavalok = [])
    {
        $this->mertekegysegAtvalto = new MertekegysegAtvalto();
        $this->hozzavalokPerKategoria = [];

        foreach ($hozzavalok as $hozzavalo) {
            $this->add($hozzavalo);
        }
    }

    public function add(Hozzavalo $hozzavalo): self
    {
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] ?? null;

        if (empty($hozzaadottHozzavalo)) {
            $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] = $hozzavalo;
            $this->sort();

            return $this;
        }

        if ($hozzaadottHozzavalo->getNev() === $hozzavalo->getNev()
            && $hozzaadottHozzavalo->getMertekegyseg() !== $hozzavalo->getMertekegyseg()
        ) {
            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $hozzavalo->getMennyiseg(),
                $hozzavalo->getMertekegyseg(),
                $hozzaadottHozzavalo->getMertekegyseg()
            );

            $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] = Hozzavalo::fromHozzavalo(
                $hozzaadottHozzavalo,
                $hozzaadottHozzavalo->getMennyiseg() + $newMennyiseg
            );
            $this->sort();

            return $this;
        }

        if (
            $hozzaadottHozzavalo->getNev() === $hozzavalo->getNev()
            && $hozzaadottHozzavalo->getMertekegyseg() === $hozzavalo->getMertekegyseg()
        ) {
            $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] = Hozzavalo::fromHozzavalo(
                $hozzaadottHozzavalo,
                $hozzaadottHozzavalo->getMennyiseg() + $hozzavalo->getMennyiseg()
            );
        }

        $this->sort();

        return $this;
    }

    public function canAdd(Hozzavalo $hozzavalo): bool
    {
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] ?? null;

        if (empty($hozzaadottHozzavalo)) {
            return true;
        }

        return $hozzaadottHozzavalo->getNev() === $hozzavalo->getNev();
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
