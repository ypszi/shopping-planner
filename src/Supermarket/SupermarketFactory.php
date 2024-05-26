<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourg;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketException;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierKategoriaMap;

class SupermarketFactory
{
    public static function create(string $name): Supermarket
    {
        return match ($name) {
            KauflandTrier::name() => new KauflandTrier(
                new KauflandTrierKategoriaMap(),
                new KauflandTrierHozzavaloToKategoriaMap()
            ),
            AuchanLuxembourg::name() => new AuchanLuxembourg(
                new AuchanLuxembourgKategoriaMap(),
                new AuchanLuxembourgHozzavaloToKategoriaMap()
            ),
            default => throw new UnknownSupermarketException(sprintf('Unknown supermarket: "%s"', $name)),
        };
    }

    /**
     * @return string[]
     */
    public static function listAvailableSupermarkets(): array
    {
        $supermarketNames = [
            KauflandTrier::name(),
            AuchanLuxembourg::name(),
        ];

        sort($supermarketNames);

        return $supermarketNames;
    }
}
