<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;

abstract class MertekegysegValto
{
    public function valt(float $mennyiseg): float
    {
        return $mennyiseg * $this->getMultiplier();
    }

    abstract public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool;

    abstract protected function getMultiplier(): float;
}
