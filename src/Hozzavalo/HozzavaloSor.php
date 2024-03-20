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

        if ($this->canAddUsingConvert($hozzavalo, $hozzaadottHozzavalo)) {
            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $hozzavalo,
                $hozzaadottHozzavalo
            );

            $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] = Hozzavalo::fromHozzavaloWithMennyiseg(
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
            $this->hozzavalokPerKategoria[$hozzavalo->getKategoria()] = Hozzavalo::fromHozzavaloWithMennyiseg(
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

        if ($this->canAddUsingConvert($hozzavalo, $hozzaadottHozzavalo)) {
            return true;
        }

        return $hozzaadottHozzavalo->getNev() === $hozzavalo->getNev()
               && $hozzaadottHozzavalo->getMertekegyseg() === $hozzavalo->getMertekegyseg();
    }

    public function convert(): self
    {
        foreach ($this->hozzavalokPerKategoria as $kategoria => $hozzavalo) {
            $newMertekegyseg = Hozzavalo::MERTEKEGYSEG_PREFERENCE[$hozzavalo->getNev()] ?? $hozzavalo->getMertekegyseg();

            if ($newMertekegyseg === $hozzavalo->getMertekegyseg()) {
                continue;
            }

            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $hozzavalo,
                Hozzavalo::fromHozzavaloWithMertekegyseg($hozzavalo, $newMertekegyseg)
            );

            $this->hozzavalokPerKategoria[$kategoria] = Hozzavalo::fromHozzavalo($hozzavalo, $newMennyiseg, $newMertekegyseg);
        }

        return $this;
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

    private function canAddUsingConvert(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        if (
            $hozzaadottHozzavalo->getNev() === $hozzavalo->getNev()
            && $hozzaadottHozzavalo->getMertekegyseg() !== $hozzavalo->getMertekegyseg()
        ) {
            return $this->mertekegysegAtvalto->canValt(
                $hozzavalo,
                $hozzaadottHozzavalo
            );
        }

        return false;
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
