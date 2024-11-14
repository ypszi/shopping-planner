<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Mertekegyseg;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Atvaltas\MertekegysegValtoCollection;

class MertekegysegAtvalto
{
    private MertekegysegValtoCollection $mertekegysegValtoCollection;

    public function __construct()
    {
        $this->mertekegysegValtoCollection = new MertekegysegValtoCollection();
    }

    public function canValt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): bool
    {
        try {
            $this->mertekegysegValtoCollection->get($hozzavalo, $hozzaadottHozzavalo);
        } catch (UnknownUnitOfMeasureException) {
            return false;
        }

        return true;
    }

    public function valt(Ingredient $hozzavalo, Ingredient $hozzaadottHozzavalo): float
    {
        return $this->mertekegysegValtoCollection->get($hozzavalo, $hozzaadottHozzavalo)->valt($hozzavalo->portion());
    }
}
