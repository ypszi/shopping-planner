<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Edesburgonya;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TepsisEdesburgonya extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Tepsis édesburgonya';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new Edesburgonya(1, Mertekegyseg::KG),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return '';
    }
}
