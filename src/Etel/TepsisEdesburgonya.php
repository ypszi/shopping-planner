<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

class TepsisEdesburgonya extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Tepsis Égesburgonya';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [];
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
