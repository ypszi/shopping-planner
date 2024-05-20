<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketKategoriaException;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class KauflandTrierKategoriaMap implements KategoriaMap
{
    #[\Override] public function map(Kategoria $kategoria): Kategoria
    {
        $mappedKategoria = $this->kategoriaMap()[$kategoria->value()] ?? null;

        if (!isset($mappedKategoria)) {
            throw new UnknownSupermarketKategoriaException(sprintf('Kategoria "%s" cannot be mapped for "%s"', $kategoria->value(), KauflandTrier::name()));
        }

        return KauflandTrierKategoria::from($mappedKategoria);
    }

    /**
     * @return array<string, string>
     */
    private function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::ZOLDSEG->value        => KauflandTrierKategoria::ZOLDSEG->value,
            HozzavaloKategoria::FUSZER_ES_OLAJ->value => KauflandTrierKategoria::FUSZER_ES_OLAJ->value,
            HozzavaloKategoria::BOR->value            => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::PEKARU->value         => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::HOSSZU_SOROK->value   => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::FELVAGOTT->value      => KauflandTrierKategoria::HUS->value,
            HozzavaloKategoria::HUS->value            => KauflandTrierKategoria::HUS->value,
            HozzavaloKategoria::HUTOS->value          => KauflandTrierKategoria::HUTOS->value,
            HozzavaloKategoria::MIRELIT->value        => KauflandTrierKategoria::HUTOS->value,
            HozzavaloKategoria::TEJTERMEK->value      => KauflandTrierKategoria::HUTOS->value,
            HozzavaloKategoria::HUTOS_UTAN->value     => KauflandTrierKategoria::HUTOS_UTAN->value,
            HozzavaloKategoria::UDITOK->value         => KauflandTrierKategoria::UDITOK->value,
        ];
    }
}
