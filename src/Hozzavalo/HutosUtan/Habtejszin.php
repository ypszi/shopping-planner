<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Habtejszin extends HutosUtan
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::DL)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg, static::kategoria());
    }

    #[\Override] public static function name(): string
    {
        return 'Habtejszín';
    }
}
