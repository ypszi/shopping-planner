<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanLuxembourg;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\Exception\UnknownSupermarketKategoriaException;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class AuchanLuxembourgKategoriaMap implements KategoriaMap
{
    #[Override] public function map(Kategoria $kategoria): Kategoria
    {
        $mappedKategoria = $this->kategoriaMap()[$kategoria->value()] ?? null;

        if (!isset($mappedKategoria)) {
            throw new UnknownSupermarketKategoriaException(sprintf('Kategoria "%s" cannot be mapped for "%s"', $kategoria->value(), AuchanLuxembourg::name()));
        }

        return AuchanLuxembourgKategoria::from($mappedKategoria);
    }

    /**
     * @return array<string, string>
     */
    private function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => AuchanLuxembourgKategoria::ZOLDSEG_GYUMOLCS->value,
            HozzavaloKategoria::OLAJ->value              => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER->value,
            HozzavaloKategoria::ECET->value              => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER->value,
            HozzavaloKategoria::FUSZER->value            => AuchanLuxembourgKategoria::KONZERV_SZOSZ_OLAJ_ECET_FUSZER->value,
            HozzavaloKategoria::BOR->value               => AuchanLuxembourgKategoria::UDITO->value,
            HozzavaloKategoria::PEKARU->value            => AuchanLuxembourgKategoria::PEKARU->value,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => AuchanLuxembourgKategoria::TESZTA_RIZS_PARADICSOMSZOSZ_PURE->value,
            HozzavaloKategoria::CUKRASZ->value           => AuchanLuxembourgKategoria::CUKRASZ_KEKSZ->value,
            HozzavaloKategoria::FELVAGOTT->value         => AuchanLuxembourgKategoria::FELVAGOTT->value,
            HozzavaloKategoria::HUS->value               => AuchanLuxembourgKategoria::HUS->value,
            HozzavaloKategoria::MIRELIT->value           => AuchanLuxembourgKategoria::MIRELIT->value,
            HozzavaloKategoria::TEJTERMEK->value         => AuchanLuxembourgKategoria::TEJTERMEK->value,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => AuchanLuxembourgKategoria::TARTOS_TEJTERMEK->value,
            HozzavaloKategoria::AZSIAI->value            => AuchanLuxembourgKategoria::NEMZETKOZI->value,
            HozzavaloKategoria::UDITO->value             => AuchanLuxembourgKategoria::UDITO->value,
        ];
    }
}
