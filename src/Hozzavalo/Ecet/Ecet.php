<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Ecet;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Ecet extends Hozzavalo
{
    public function __construct(float $mennyiseg, string $mertekegyseg)
    {
        parent::__construct($mennyiseg, $mertekegyseg, HozzavaloKategoria::ECET);
    }

    #[Override] public static function name(): string
    {
        return 'Ecet';
    }

    #[Override] public static function mertekegysegPreference(): ?string
    {
        return Mertekegyseg::L;
    }
}
