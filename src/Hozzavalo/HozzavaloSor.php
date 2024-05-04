<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
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
        $this->mertekegysegAtvalto    = new MertekegysegAtvalto();
        $this->hozzavalokPerKategoria = [];

        foreach ($hozzavalok as $hozzavalo) {
            $this->add($hozzavalo);
        }
    }

    /**
     * @return array<string, Hozzavalo>
     */
    public function getHozzavalokPerKategoria(): array
    {
        return $this->hozzavalokPerKategoria;
    }

    public function add(Hozzavalo $hozzavalo): self
    {
        $hozzavalo           = $this->convertToPreference($hozzavalo);
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo::kategoria()] ?? null;

        if (empty($hozzaadottHozzavalo)) {
            $this->hozzavalokPerKategoria[$hozzavalo::kategoria()] = $hozzavalo;
            $this->sort();

            return $this;
        }

        if ($this->canAddUsingConvert($hozzavalo, $hozzaadottHozzavalo)) {
            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $hozzavalo,
                $hozzaadottHozzavalo
            );

            $this->hozzavalokPerKategoria[$hozzavalo::kategoria()] = $hozzaadottHozzavalo->withMennyiseg(
                $hozzaadottHozzavalo->getMennyiseg() + $newMennyiseg
            );
            $this->sort();

            return $this;
        }

        if (
            $hozzaadottHozzavalo::name() === $hozzavalo::name()
            && $hozzaadottHozzavalo->getMertekegyseg() === $hozzavalo->getMertekegyseg()
        ) {
            $this->hozzavalokPerKategoria[$hozzavalo::kategoria()] = $hozzaadottHozzavalo->withMennyiseg(
                $hozzaadottHozzavalo->getMennyiseg() + $hozzavalo->getMennyiseg()
            );
        }

        $this->sort();

        return $this;
    }

    public function canAdd(Hozzavalo $hozzavalo): bool
    {
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo::kategoria()] ?? null;

        if (empty($hozzaadottHozzavalo)) {
            return true;
        }

        if ($this->canAddUsingConvert($hozzavalo, $hozzaadottHozzavalo)) {
            return true;
        }

        return $hozzaadottHozzavalo::name() === $hozzavalo::name()
               && $hozzaadottHozzavalo->getMertekegyseg() === $hozzavalo->getMertekegyseg();
    }

    private function convertToPreference(Hozzavalo $hozzavalo): Hozzavalo
    {
        $newMertekegyseg = $hozzavalo::mertekegysegPreference() ?? $hozzavalo->getMertekegyseg();

        if ($newMertekegyseg === $hozzavalo->getMertekegyseg()) {
            return $hozzavalo;
        }

        try {
            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $hozzavalo,
                $hozzavalo->withMertekegyseg($newMertekegyseg)
            );
        } catch (UnknownUnitOfMeasureException) {
            $newMennyiseg    = $hozzavalo->getMennyiseg();
            $newMertekegyseg = $hozzavalo->getMertekegyseg();
        }

        return $hozzavalo
            ->withMennyiseg($newMennyiseg)
            ->withMertekegyseg($newMertekegyseg);
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
            $hozzaadottHozzavalo::name() === $hozzavalo::name()
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
