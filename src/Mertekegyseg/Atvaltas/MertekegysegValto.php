<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

abstract class MertekegysegValto
{
    public function valt(float $mennyiseg): float
    {
        return $mennyiseg * $this->getMultiplier();
    }

    abstract public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool;

    abstract protected function getMultiplier(): float;
}
