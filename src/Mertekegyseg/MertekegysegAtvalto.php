<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\Exception\UnknownUnitOfMeasureException;
use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValtoCollection;

class MertekegysegAtvalto
{
    private MertekegysegValtoCollection $mertekegysegValtoCollection;

    public function __construct()
    {
        $this->mertekegysegValtoCollection = new MertekegysegValtoCollection();
    }

    public function canValt(string $mertekegyseget, string $mertekegysegre): bool
    {
        try {
            $this->mertekegysegValtoCollection->get($mertekegyseget, $mertekegysegre);
        } catch (UnknownUnitOfMeasureException) {
            return false;
        }

        return true;
    }

    public function valt(float $mennyiseg, string $mertekegyseget, string $mertekegysegre): float
    {
        return $this->mertekegysegValtoCollection->get($mertekegyseget, $mertekegysegre)->valt($mennyiseg);
    }
}
