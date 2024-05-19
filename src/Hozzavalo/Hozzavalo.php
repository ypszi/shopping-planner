<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

abstract class Hozzavalo
{
    private float $mennyiseg;

    private string $mertekegyseg;

    private Kategoria $kategoria;

    public function __construct(float $mennyiseg, string $mertekegyseg, Kategoria $kategoria)
    {
        $this->mennyiseg    = $mennyiseg;
        $this->mertekegyseg = $mertekegyseg;
        $this->kategoria    = $kategoria;
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

    public function withKategoria(Kategoria $kategoria): self
    {
        $clone            = clone $this;
        $clone->kategoria = $kategoria;

        return $clone;
    }

    abstract public static function name(): string;

    public function kategoria(): Kategoria
    {
        return $this->kategoria;
    }

    public static function mertekegysegPreference(): ?string
    {
        return null;
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
        return sprintf('%.2f %s %s', $this->mennyiseg, $this->mertekegyseg, static::name());
    }
}
