<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingList;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingListByFood;

class Supermarket
{
    final public const DEFAULT = 'Auchan - Csömör';

    /**
     * @param string[] $categories
     */
    public function __construct(
        private readonly string $name,
        private readonly array $categories,
        private readonly CategoryMap $categoryMap,
        private readonly ?IngredientToCategoryMap $ingredientToCategoryMap = null
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string[]
     */
    public function sorrend(): array
    {
        return $this->categories;
    }

    public function toShoppingList(Etelek $etelek): ShoppingList
    {
        $hozzavalokByKategoria = new HozzavalokByKategoria();
        foreach ($etelek as $etel) {
            $hozzavalokByKategoria->addMultipleHozzavalo($etel->hozzavalok());
        }

        return new ShoppingList($this->sorrend(), $this->createHozzavaloSorok($hozzavalokByKategoria)->toArray());
    }

    public function toShoppingListByFood(Etelek $etelek): ShoppingListByFood
    {
        $rows = [];
        foreach ($etelek as $etel) {
            $hozzavalokByKategoria = new HozzavalokByKategoria();
            $hozzavalokByKategoria->addMultipleHozzavalo($etel->hozzavalok());

            $rows[$etel->name()] = $this->createHozzavaloSorok($hozzavalokByKategoria)->toArray();
        }

        return new ShoppingListByFood($this->sorrend(), $rows);
    }

    private function createHozzavaloSorok(HozzavalokByKategoria $hozzavalokByKategoria): HozzavaloSorok
    {
        $hozzavaloSorok = new HozzavaloSorok($this);

        foreach ($hozzavalokByKategoria as $hozzavalok) {
            /** @var Hozzavalo $hozzavalo */
            foreach ($hozzavalok as $hozzavalo) {
                $hozzavalo = $hozzavalo->withKategoria(
                    $this->categoryMap->map($hozzavalo->kategoria())
                );

                if ($this->ingredientToCategoryMap) {
                    $hozzavalo = $hozzavalo->withKategoria(
                        $this->ingredientToCategoryMap->map($hozzavalo)
                    );
                }

                $hozzavaloSorok->addHozzavalo($hozzavalo);
            }
        }

        return $hozzavaloSorok->sort();
    }
}
