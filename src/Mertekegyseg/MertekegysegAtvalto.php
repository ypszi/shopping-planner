<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValtoCollection;

class MertekegysegAtvalto
{
    private MertekegysegValtoCollection $mertekegysegValtoCollection;

    public function __construct()
    {
        $this->mertekegysegValtoCollection = new MertekegysegValtoCollection();
    }

    public function canValt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): bool
    {
        try {
            $this->mertekegysegValtoCollection->get($hozzavalo, $hozzaadottHozzavalo);
        } catch (UnknownUnitOfMeasureException) {
            return false;
        }

        return true;
    }

    public function valt(Hozzavalo $hozzavalo, Hozzavalo $hozzaadottHozzavalo): float
    {
        return $this->mertekegysegValtoCollection->get($hozzavalo, $hozzaadottHozzavalo)->valt($hozzavalo->getMennyiseg());
    }
}
