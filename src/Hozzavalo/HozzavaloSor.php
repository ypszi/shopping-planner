<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\Kajatervezo\Mertekegyseg\MertekegysegAtvalto;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class HozzavaloSor
{
    private MertekegysegAtvalto $mertekegysegAtvalto;

    /** @var array<string, Hozzavalo> */
    private array $hozzavalokPerKategoria;

    public function __construct()
    {
        $this->mertekegysegAtvalto    = new MertekegysegAtvalto();
        $this->hozzavalokPerKategoria = [];
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
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo->kategoria()->value()] ?? null;

        if (empty($hozzaadottHozzavalo)) {
            $this->hozzavalokPerKategoria[$hozzavalo->kategoria()->value()] = $hozzavalo;

            return $this;
        }

        if ($this->canAddUsingConvert($hozzavalo, $hozzaadottHozzavalo)) {
            $newMennyiseg = $this->mertekegysegAtvalto->valt(
                $hozzavalo,
                $hozzaadottHozzavalo
            );

            $this->hozzavalokPerKategoria[$hozzavalo->kategoria()->value()] = $hozzaadottHozzavalo->withMennyiseg(
                $hozzaadottHozzavalo->getMennyiseg() + $newMennyiseg
            );

            return $this;
        }

        if (
            $hozzaadottHozzavalo::name() === $hozzavalo::name()
            && $hozzaadottHozzavalo->getMertekegyseg() === $hozzavalo->getMertekegyseg()
        ) {
            $this->hozzavalokPerKategoria[$hozzavalo->kategoria()->value()] = $hozzaadottHozzavalo->withMennyiseg(
                $hozzaadottHozzavalo->getMennyiseg() + $hozzavalo->getMennyiseg()
            );
        }

        return $this;
    }

    public function canAdd(Hozzavalo $hozzavalo): bool
    {
        $hozzaadottHozzavalo = $this->hozzavalokPerKategoria[$hozzavalo->kategoria()->value()] ?? null;

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
    public function toArray(Supermarket $supermarket): array
    {
        $sor = [];
        foreach ($supermarket::sorrend() as $kategoria) {
            $hozzavalo = $this->hozzavalokPerKategoria[$kategoria] ?? null;
            $sor[]     = $hozzavalo ? (string)$hozzavalo : '';
        }

        $notFoundCategories = array_diff(array_keys($this->hozzavalokPerKategoria), $supermarket::sorrend());

        foreach ($notFoundCategories as $kategoria) {
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

    /**
     * @param string[] $sorrend
     */
    public function sort(array $sorrend): self
    {
        uksort(
            $this->hozzavalokPerKategoria,
            fn(string $hozzavaloKategoria1, string $hozzavaloKategoria2) => array_search($hozzavaloKategoria1, $sorrend) <=> array_search($hozzavaloKategoria2, $sorrend)
        );

        return $this;
    }
}
