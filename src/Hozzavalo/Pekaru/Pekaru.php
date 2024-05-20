<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Pekaru;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;

abstract class Pekaru extends Hozzavalo
{
    public function __construct(float $mennyiseg, string $mertekegyseg)
    {
        parent::__construct($mennyiseg, $mertekegyseg, HozzavaloKategoria::PEKARU);
    }
}
