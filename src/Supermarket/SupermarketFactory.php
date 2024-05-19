<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketException;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;

class SupermarketFactory
{
    public static function create(string $name): Supermarket
    {
        return match ($name) {
            KauflandTrier::name() => new KauflandTrier(),
            default => throw new UnknownSupermarketException(sprintf('Unknown supermarket: "%s"', $name)),
        };
    }
}
