<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketKategoriaException;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class KauflandTrierKategoriaMap implements KategoriaMap
{
    #[Override] public function map(Kategoria $kategoria): Kategoria
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
            HozzavaloKategoria::ECET->value              => KauflandTrierKategoria::ZOLDSEG_GYUMOLCS->value,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => KauflandTrierKategoria::ZOLDSEG_GYUMOLCS->value,
            HozzavaloKategoria::OLAJ->value              => KauflandTrierKategoria::FUSZER_ES_OLAJ->value,
            HozzavaloKategoria::FUSZER->value            => KauflandTrierKategoria::FUSZER_ES_OLAJ->value,
            HozzavaloKategoria::BOR->value               => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::PEKARU->value            => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::CUKRASZ->value           => KauflandTrierKategoria::HOSSZU_SOROK->value,
            HozzavaloKategoria::FELVAGOTT->value         => KauflandTrierKategoria::HUS->value,
            HozzavaloKategoria::HUS->value               => KauflandTrierKategoria::HUS->value,
            HozzavaloKategoria::MIRELIT->value           => KauflandTrierKategoria::HUTOS->value,
            HozzavaloKategoria::TEJTERMEK->value         => KauflandTrierKategoria::HUTOS->value,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => KauflandTrierKategoria::HUTOS_UTAN->value,
            HozzavaloKategoria::AZSIAI->value            => KauflandTrierKategoria::HUTOS_UTAN->value,
            HozzavaloKategoria::UDITO->value             => KauflandTrierKategoria::UDITO->value,
        ];
    }
}
