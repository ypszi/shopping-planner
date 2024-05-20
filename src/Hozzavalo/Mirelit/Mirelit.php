<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Mirelit;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

abstract class Mirelit extends Hozzavalo
{
    public function __construct(float $mennyiseg, string $mertekegyseg)
    {
        parent::__construct($mennyiseg, $mertekegyseg, HozzavaloKategoria::MIRELIT);
    }

    #[\Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::G;
    }
}
