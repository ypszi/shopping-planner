<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

abstract class Etel
{
    /** @var Hozzavalo[] */
    protected array $hozzavalok;

    public function __construct()
    {
        $this->hozzavalok = static::listHozzavalok();
    }

    abstract public static function getName(): string;

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
}
