<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Hozzavalo
{
    private string $name;

    private float $mennyiseg;

    private Mertekegyseg $mertekegyseg;

    private string $category;

    private ?Mertekegyseg $mertekegysegPreference;

    public function __construct(
        string $name,
        float $mennyiseg,
        Mertekegyseg $mertekegyseg,
        string $kategoria,
        ?Mertekegyseg $mertekegysegPreference = null
    ) {
        $this->name                   = $name;
        $this->mennyiseg              = $mennyiseg;
        $this->mertekegyseg           = $mertekegyseg;
        $this->category              = $kategoria;
        $this->mertekegysegPreference = $mertekegysegPreference;
    }

    public function withMennyiseg(float $mennyiseg): self
    {
        $clone            = clone $this;
        $clone->mennyiseg = $mennyiseg;

        return $clone;
    }

    public function withMertekegyseg(Mertekegyseg $mertekegyseg): self
    {
        $clone               = clone $this;
        $clone->mertekegyseg = $mertekegyseg;

        return $clone;
    }

    public function withKategoria(string $kategoria): self
    {
        $clone           = clone $this;
        $clone->category = $kategoria;

        return $clone;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function kategoria(): string
    {
        return $this->category;
    }

    public function mertekegysegPreference(): ?Mertekegyseg
    {
        return $this->mertekegysegPreference;
    }

    public function getMennyiseg(): float
    {
        return $this->mennyiseg;
    }

    public function getMertekegyseg(): Mertekegyseg
    {
        return $this->mertekegyseg;
    }

    public function __toString(): string
    {
        return sprintf('%.2f %s %s', $this->mennyiseg, $this->mertekegyseg->value, static::name());
    }
}
