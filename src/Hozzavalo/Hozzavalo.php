<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

abstract class Hozzavalo
{
    private string $nev;

    private float $mennyiseg;

    private string $mertekegyseg;

    public function __construct(string $name, float $mennyiseg, string $mertekegyseg)
    {
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

    abstract public static function name(): string;

    abstract public static function kategoria(): string;

    public static function mertekegysegPreference(): ?string
    {
        return null;
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
