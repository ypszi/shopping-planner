<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Mertekegyseg;

use PeterPecosz\Kajatervezo\Mertekegyseg\Atvaltas\MertekegysegValtoCollection;

class MertekegysegAtvalto
{
    private MertekegysegValtoCollection $mertekegysegValtoCollection;

    public function __construct()
    {
        $this->mertekegysegValtoCollection = new MertekegysegValtoCollection();
    }

    public function valt(float $mennyiseg, string $mertekegyseget, string $mertekegysegre): float
    {
        return $this->mertekegysegValtoCollection->get($mertekegyseget, $mertekegysegre)->valt($mennyiseg);
    }
}
