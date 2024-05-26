<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;

abstract class Supermarket
{
    private KategoriaMap $kategoriaMap;

    private HozzavaloToKategoriaMap $hozzavaloToKategoriaMap;

    public function __construct(KategoriaMap $kategoriaMap, HozzavaloToKategoriaMap $hozzavaloToKategoriaMap)
    {
        $this->kategoriaMap            = $kategoriaMap;
        $this->hozzavaloToKategoriaMap = $hozzavaloToKategoriaMap;
    }

    abstract public static function name(): string;

    /**
     * @return string[]
     */
    abstract public static function sorrend(): array;

    /**
     * @return array<string[]>
     */
    public function toShoppingList(HozzavalokByKategoria $hozzavalokByKategoria): array
    {
        return $this->createHozzavaloSorok($hozzavalokByKategoria)->toArray();
    }

    private function createHozzavaloSorok(HozzavalokByKategoria $hozzavalokByKategoria): HozzavaloSorok
    {
        $hozzavaloSorok = new HozzavaloSorok($this);

        foreach ($hozzavalokByKategoria as $hozzavalok) {
            /** @var Hozzavalo $hozzavalo */
            foreach ($hozzavalok as $hozzavalo) {
                $hozzavalo = $hozzavalo->withKategoria(
                    $this->kategoriaMap->map($hozzavalo->kategoria())
                );
                $hozzavalo = $hozzavalo->withKategoria(
                    $this->hozzavaloToKategoriaMap->map($hozzavalo)
                );

                $hozzavaloSorok->addHozzavalo($hozzavalo);
            }
        }

        return $hozzavaloSorok->sort();
    }
}
