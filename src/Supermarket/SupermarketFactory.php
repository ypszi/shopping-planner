<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomor;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomorKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourg;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg\AuchanLuxembourgKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketException;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierHozzavaloToKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrierKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig\LidlWasserbillig;
use PeterPecosz\Kajatervezo\Supermarket\LidlWasserbillig\LidlWasserbilligKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig\MatchWasserbillig;
use PeterPecosz\Kajatervezo\Supermarket\MatchWasserbillig\MatchWasserbilligKategoriaMap;
use PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi\TescoFogarasi;
use PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi\TescoFogarasiKategoriaMap;

class SupermarketFactory
{
    public static function create(string $name): Supermarket
    {
        return match ($name) {
            AuchanCsomor::name() => new AuchanCsomor(
                new AuchanCsomorKategoriaMap(),
                new AuchanCsomorHozzavaloToKategoriaMap()
            ),
            TescoFogarasi::name() => new TescoFogarasi(
                new TescoFogarasiKategoriaMap()
            ),
            KauflandTrier::name() => new KauflandTrier(
                new KauflandTrierKategoriaMap(),
                new KauflandTrierHozzavaloToKategoriaMap()
            ),
            AuchanLuxembourg::name() => new AuchanLuxembourg(
                new AuchanLuxembourgKategoriaMap(),
                new AuchanLuxembourgHozzavaloToKategoriaMap()
            ),
            LidlWasserbillig::name() => new LidlWasserbillig(
                new LidlWasserbilligKategoriaMap()
            ),
            MatchWasserbillig::name() => new MatchWasserbillig(
                new MatchWasserbilligKategoriaMap()
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
            AuchanCsomor::name(),
            LidlWasserbillig::name(),
            MatchWasserbillig::name(),
        ];

        sort($supermarketNames);

        return $supermarketNames;
    }
}
