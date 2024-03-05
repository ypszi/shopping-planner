<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

abstract class Etel
{
    /**
     * @var array<Hozzavalo>
     */
    protected array $hozzavalok;

    public function __construct()
    {
        $this->hozzavalok = [];
    }

    abstract public static function getName(): string;

    /**
     * @return array<Hozzavalo>
     */
    public function getHozzavalok(): array
    {
        return $this->hozzavalok;
    }
}
