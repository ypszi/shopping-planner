<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class KauflandTrier implements Supermarket
{
    private KauflandTrierKategoriaMap $kategoriaMap;

    private KauflandTrierHozzavaloToKategoriaMap $hozzavaloToKategoriaMap;

    public function __construct()
    {
        $this->kategoriaMap            = new KauflandTrierKategoriaMap();
        $this->hozzavaloToKategoriaMap = new KauflandTrierHozzavaloToKategoriaMap();
    }

    public static function name(): string
    {
        return 'Kaufland - Trier';
    }

    /**
     * @return string[]
     */
    #[Override] public static function sorrend(): array
    {
        return [
            KauflandTrierKategoria::ZOLDSEG->value,
            KauflandTrierKategoria::FUSZER_ES_OLAJ->value,
            KauflandTrierKategoria::HOSSZU_SOROK->value,
            KauflandTrierKategoria::HUS->value,
            KauflandTrierKategoria::HUTOS->value,
            KauflandTrierKategoria::HUTOS_UTAN->value,
            KauflandTrierKategoria::UDITO->value,
        ];
    }

    /**
     * @return array<string[]>
     */
    #[Override] public function toShoppingList(HozzavalokByKategoria $hozzavalokByKategoria): array
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
