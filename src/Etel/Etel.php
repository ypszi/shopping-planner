<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

abstract class Etel
{
    /** @var Hozzavalo[] */
    protected array $hozzavalok;

    private int $adag;

    public function __construct(?int $adag = null)
    {
        $defaultAdag = static::getDefaultAdag();
        $this->adag  = $adag ?? $defaultAdag;

        foreach (static::listHozzavalok() as $hozzavalo) {
            $adagMennyiseg      = $hozzavalo->getMennyiseg() / $defaultAdag * $this->adag;
            $this->hozzavalok[] = Hozzavalo::fromHozzavaloWithMennyiseg($hozzavalo, $adagMennyiseg);
        }
    }

    abstract public static function getName(): string;

    abstract public static function getDefaultAdag(): int;

    /**
     * @return Hozzavalo[]
     */
    abstract protected static function listHozzavalok(): array;

    /**
     * @return Hozzavalo[]
     */
    public function getHozzavalok(): array
    {
        return $this->hozzavalok;
    }

    public function __toString(): string
    {
        return sprintf('%s (%d adag)', static::getName(), $this->adag);
    }
}
