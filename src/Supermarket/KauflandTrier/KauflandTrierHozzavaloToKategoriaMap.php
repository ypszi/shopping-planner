<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Ecet;
use PeterPecosz\Kajatervezo\Supermarket\HozzavaloToKategoriaMap;

class KauflandTrierHozzavaloToKategoriaMap implements HozzavaloToKategoriaMap
{
    #[\Override] public function map(Hozzavalo $hozzavalo): Kategoria
    {
        $mappedKategoria = $this->hozzavaloMap()[$hozzavalo::name()] ?? null;

        if (!$mappedKategoria) {
            return $hozzavalo->kategoria();
        }

        return KauflandTrierKategoria::from($mappedKategoria);
    }

    /**
     * @return array<string, string>
     */
    private function hozzavaloMap(): array
    {
        return [
            Ecet::name() => KauflandTrierKategoria::ZOLDSEG->value,
        ];
    }
}
