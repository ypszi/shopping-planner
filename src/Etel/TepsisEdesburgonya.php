<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Edesburgonya;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class TepsisEdesburgonya extends Etel
{
    public static function name(): string
    {
        return 'Tepsis édesburgonya';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Edesburgonya(1, Mertekegyseg::KG),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function receptUrl(): string
    {
        return '';
    }
}
