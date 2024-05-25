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
        $this->adag = $adag ?? static::defaultAdag();

        $this->addHozzavalok();
    }

    abstract public static function name(): string;

    abstract public static function defaultAdag(): int;

    abstract public function receptUrl(): string;

    /**
     * @return Hozzavalo[]
     */
    abstract protected function listHozzavalok(): array;

    public function withAdag(int $adag): self
    {
        $clone       = clone $this;
        $clone->adag = $adag;

        $clone->addHozzavalok();

        return $clone;
    }

    /**
     * @return Hozzavalo[]
     */
    public function hozzavalok(): array
    {
        return $this->hozzavalok;
    }

    protected function decorateNoSaltyReceptUrl(string $receptUrl): string
    {
        if (str_contains($receptUrl, 'nosalty.hu')) {
            return sprintf('%s?adag=%d', $receptUrl, $this->adag);
        }

        return $receptUrl;
    }

    public function __toString(): string
    {
        return sprintf('%s (%d adag)', static::name(), $this->adag);
    }

    private function addHozzavalok(): void
    {
        $this->hozzavalok = [];

        foreach ($this->listHozzavalok() as $hozzavalo) {
            $adagMennyiseg      = $hozzavalo->getMennyiseg() / static::defaultAdag() * $this->adag;
            $this->hozzavalok[] = $hozzavalo->withMennyiseg($adagMennyiseg);
        }
    }
}
