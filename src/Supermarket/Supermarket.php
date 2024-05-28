<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingList;

abstract class Supermarket
{
    private KategoriaMap $kategoriaMap;

    private ?HozzavaloToKategoriaMap $hozzavaloToKategoriaMap;

    public function __construct(KategoriaMap $kategoriaMap, ?HozzavaloToKategoriaMap $hozzavaloToKategoriaMap = null)
    {
        $this->kategoriaMap            = $kategoriaMap;
        $this->hozzavaloToKategoriaMap = $hozzavaloToKategoriaMap;
    }

    abstract public static function name(): string;

    /**
     * @return string[]
     */
    abstract public static function sorrend(): array;

    public function toShoppingList(Etelek $etelek): ShoppingList
    {
        $hozzavalokByKategoria = new HozzavalokByKategoria();
        foreach ($etelek as $etel) {
            $hozzavalokByKategoria->addMultipleHozzavalo($etel->hozzavalok());
        }

        return new ShoppingList(
            $this->sorrend(),
            $this->createHozzavaloSorok($hozzavalokByKategoria)->toArray()
        );
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

                if ($this->hozzavaloToKategoriaMap) {
                    $hozzavalo = $hozzavalo->withKategoria(
                        $this->hozzavaloToKategoriaMap->map($hozzavalo)
                    );
                }

                $hozzavaloSorok->addHozzavalo($hozzavalo);
            }
        }

        return $hozzavaloSorok->sort();
    }
}
