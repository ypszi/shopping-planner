<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\FuszerEsOlaj;

use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ErolevesKocka extends FuszerEsOlaj
{
    public function __construct(float $mennyiseg, string $mertekegyseg = Mertekegyseg::DB)
    {
        parent::__construct(static::name(), $mennyiseg, $mertekegyseg, static::kategoria());
    }

    #[\Override] public static function name(): string
    {
        return 'Erőleves kocka';
    }
}
