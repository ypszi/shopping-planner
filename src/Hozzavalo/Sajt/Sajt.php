<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Sajt;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;

abstract class Sajt extends Hozzavalo
{
    public function __construct(float $mennyiseg, string $mertekegyseg)
    {
        parent::__construct($mennyiseg, $mertekegyseg, HozzavaloKategoria::SAJT);
    }
}
