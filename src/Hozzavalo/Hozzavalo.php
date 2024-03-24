<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo;

use PeterPecosz\Kajatervezo\Hozzavalo\Exception\UnknownHozzavaloException;

class Hozzavalo
{
    /* HUTOS */
    final public const string FETA_SAJT = 'Feta sajt';
    final public const string MOZZARELLA_SAJT = 'Mozzarella sajt';
    final public const string NATUR_JOGHURT = 'Natúr joghurt';
    final public const string KEFIR = 'Kefír';
    final public const string PARMEZAN = 'Parmezán';
    final public const string TEJFOL = 'Tejföl';
    final public const string TOJAS = 'Tojás';
    /* HUTOS_UTAN */
    final public const string FOZO_TEJSZIN = 'Főzőtejszín';
    final public const string HABTEJSZIN = 'Habtejszín';
    final public const string KETCHUP = 'Ketchup';
    final public const string TEJ = 'Tej';
    final public const string TEJSZIN = 'Főzőtejszín';
    final public const string VAJ = 'Vaj';
    private const array HOZZAVALO_KATEGORIA = [
        self::FETA_SAJT       => HozzavaloKategoria::HUTOS,
        self::MOZZARELLA_SAJT => HozzavaloKategoria::HUTOS,
        self::NATUR_JOGHURT   => HozzavaloKategoria::HUTOS,
        self::KEFIR           => HozzavaloKategoria::HUTOS,
        self::PARMEZAN        => HozzavaloKategoria::HUTOS,
        self::TEJFOL          => HozzavaloKategoria::HUTOS,
        self::TOJAS           => HozzavaloKategoria::HUTOS,
        self::FOZO_TEJSZIN    => HozzavaloKategoria::HUTOS_UTAN,
        self::HABTEJSZIN      => HozzavaloKategoria::HUTOS_UTAN,
        self::KETCHUP         => HozzavaloKategoria::HUTOS_UTAN,
        self::TEJ             => HozzavaloKategoria::HUTOS_UTAN,
        self::VAJ             => HozzavaloKategoria::HUTOS_UTAN,
    ];

    private string $kategoria;

    private string $nev;

    private float $mennyiseg;

    private string $mertekegyseg;

    // TODO: remove $kategoria arg [peter.pecosz]
    public function __construct(string $name, float $mennyiseg, string $mertekegyseg, ?string $kategoria = null)
    {
        $kategoria = $kategoria ?: self::HOZZAVALO_KATEGORIA[$name] ?? '';

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
