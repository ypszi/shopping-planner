<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class AuchanLuxembourg implements Supermarket
{
    private AuchanLuxembourgKategoriaMap $kategoriaMap;

    private AuchanLuxembourgHozzavaloToKategoriaMap $hozzavaloToKategoriaMap;

    public function __construct()
    {
        $this->kategoriaMap            = new AuchanLuxembourgKategoriaMap();
        $this->hozzavaloToKategoriaMap = new AuchanLuxembourgHozzavaloToKategoriaMap();
    }

    public static function name(): string
    {
        return 'Auchan - Luxembourg';
    }

    /**
     * @return string[]
     */
    #[Override] public static function sorrend(): array
    {
        return [
            AuchanLuxembourgKategoria::UDITO->value,
            AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER->value,
            AuchanLuxembourgKategoria::TESZTA_RIZS_PARADICSOMSZOSZ_PURE->value,
            AuchanLuxembourgKategoria::TEA_KAVE->value,
            AuchanLuxembourgKategoria::CUKRASZ_KEKSZ->value,
            AuchanLuxembourgKategoria::NEMZETKOZI->value,
            AuchanLuxembourgKategoria::MIRELIT->value,
            AuchanLuxembourgKategoria::SAJT->value,
            AuchanLuxembourgKategoria::TARTOS_TEJTERMEK->value,
            AuchanLuxembourgKategoria::TEJTERMEK->value,
            AuchanLuxembourgKategoria::HUS->value,
            AuchanLuxembourgKategoria::FELVAGOTT->value,
            AuchanLuxembourgKategoria::JOGHURT->value,
            AuchanLuxembourgKategoria::ZOLDSEG_GYUMOLCS->value,
            AuchanLuxembourgKategoria::HAL->value,
            AuchanLuxembourgKategoria::PEKARU->value,
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
