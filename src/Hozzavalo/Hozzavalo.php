<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Hozzavalo\Exception\UnknownHozzavaloException;

class Hozzavalo
{
    private string $kategoria;

    private string $nev;

    private float $mennyiseg;

    private string $mertekegyseg;

    // TODO: remove $kategoria arg [peter.pecosz]
    public function __construct(string $name, float $mennyiseg, string $mertekegyseg, ?string $kategoria = null)
    {
        $kategoria = $kategoria ?: '';

        if (empty($kategoria)) {
            throw new UnknownHozzavaloException(sprintf('Unknown hozzavalo, cannot determine kategoria for "%s"', $name));
        }

        $this->kategoria    = $kategoria;
        $this->nev          = $name;
        $this->mennyiseg    = $mennyiseg;
        $this->mertekegyseg = $mertekegyseg;
    }

    public function withMennyiseg(float $mennyiseg): self
    {
        $clone            = clone $this;
        $clone->mennyiseg = $mennyiseg;

        return $clone;
    }

    public function withMertekegyseg(string $mertekegyseg): self
    {
        $clone               = clone $this;
        $clone->mertekegyseg = $mertekegyseg;

        return $clone;
    }

    // TODO: make abstract [peter.pecosz]
    public static function name(): string
    {
        return '';
    }

    // TODO: make abstract [peter.pecosz]
    public static function kategoria(): string
    {
        return '';
    }

    public static function mertekegysegPreference(): ?string
    {
        return null;
    }

    public function getKategoria(): string
    {
        return $this->kategoria;
    }

    public function getNev(): string
    {
        return $this->nev;
    }

    public function getMennyiseg(): float
    {
        return $this->mennyiseg;
    }

    public function getMertekegyseg(): string
    {
        return $this->mertekegyseg;
    }

    public function __toString(): string
    {
        return sprintf('%.2f %s %s', $this->mennyiseg, $this->mertekegyseg, $this->nev);
    }
}
