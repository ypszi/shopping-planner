<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class KauflandTrier implements Supermarket
{
    private KauflandTrierKategoriaMap $kategoriaMap;

    private ?HozzavaloSorok $hozzavaloSorok = null;

    public function __construct()
    {
        $this->kategoriaMap = new KauflandTrierKategoriaMap();
    }

    public static function name(): string
    {
        return 'Kaufland - Trier';
    }

    /**
     * @return string[]
     */
    #[\Override] public static function sorrend(): array
    {
        return [
            KauflandTrierKategoria::ZOLDSEG->value,
            KauflandTrierKategoria::FUSZER_ES_OLAJ->value,
            KauflandTrierKategoria::HOSSZU_SOROK->value,
            KauflandTrierKategoria::HUS->value,
            KauflandTrierKategoria::HUTOS->value,
            KauflandTrierKategoria::HUTOS_UTAN->value,
            KauflandTrierKategoria::UDITOK->value,
        ];
    }

    /**
     * @return array<string[]>
     */
    #[\Override] public function toShoppingList(HozzavalokByKategoria $hozzavalokByKategoria): array
    {
        $this->createHozzavaloSorok($hozzavalokByKategoria);

        return $this->hozzavaloSorok?->toArray();
    }

    private function createHozzavaloSorok(HozzavalokByKategoria $hozzavalokByKategoria): HozzavaloSorok
    {
        $this->hozzavaloSorok = new HozzavaloSorok($this);

        foreach ($hozzavalokByKategoria as $hozzavalok) {
            /** @var Hozzavalo $hozzavalo */
            foreach ($hozzavalok as $hozzavalo) {
                $mappedKategoria = $this->kategoriaMap::map($hozzavalo->kategoria());

                $this->hozzavaloSorok->addHozzavalo($hozzavalo->withKategoria($mappedKategoria));
            }
        }

        return $this->hozzavaloSorok->sort();
    }
}
