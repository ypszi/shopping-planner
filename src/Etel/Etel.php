<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

abstract class Etel
{
    /** @var Hozzavalo[] */
    private array $hozzavalok;

    protected int $adag;

    public function __construct(?int $adag = null)
    {
        $defaultAdag = static::defaultAdag();
        $this->adag  = $adag ?? $defaultAdag;

        foreach (static::listHozzavalok() as $hozzavalo) {
            $adagMennyiseg      = $hozzavalo->getMennyiseg() / $defaultAdag * $this->adag;
            $this->hozzavalok[] = $hozzavalo->withMennyiseg($adagMennyiseg);
        }
    }

    abstract public static function name(): string;

    abstract public static function defaultAdag(): int;

    abstract public function receptUrl(): string;

    /**
     * @return Hozzavalo[]
     */
    abstract protected static function listHozzavalok(): array;

    public function withAdag(int $adag): self
    {
        $clone       = clone $this;
        $clone->adag = $adag;

        return $clone;
    }

    /**
     * @return Hozzavalo[]
     */
    public function getHozzavalok(): array
    {
        return $this->hozzavalok;
    }

    public function __toString(): string
    {
        return sprintf('%s (%d adag)', static::name(), $this->adag);
    }
}
