<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;
use PeterPecosz\Kajatervezo\Supermarket\KategoriaMap;

class KauflandTrierKategoriaMap extends KategoriaMap
{
    /**
     * @return array<string, Kategoria>
     */
    protected function kategoriaMap(): array
    {
        return [
            HozzavaloKategoria::ECET->value              => KauflandTrierKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::ZOLDSEG_GYUMOLCS->value  => KauflandTrierKategoria::ZOLDSEG_GYUMOLCS,
            HozzavaloKategoria::OLAJ->value              => KauflandTrierKategoria::FUSZER_ES_OLAJ,
            HozzavaloKategoria::FUSZER->value            => KauflandTrierKategoria::FUSZER_ES_OLAJ,
            HozzavaloKategoria::BOR->value               => KauflandTrierKategoria::HOSSZU_SOROK,
            HozzavaloKategoria::PEKARU->value            => KauflandTrierKategoria::HOSSZU_SOROK,
            HozzavaloKategoria::TARTOS_ELELMISZER->value => KauflandTrierKategoria::HOSSZU_SOROK,
            HozzavaloKategoria::CUKRASZ->value           => KauflandTrierKategoria::HOSSZU_SOROK,
            HozzavaloKategoria::FELVAGOTT->value         => KauflandTrierKategoria::HUS,
            HozzavaloKategoria::HUS->value               => KauflandTrierKategoria::HUS,
            HozzavaloKategoria::MIRELIT->value           => KauflandTrierKategoria::HUTOS,
            HozzavaloKategoria::TEJTERMEK->value         => KauflandTrierKategoria::HUTOS,
            HozzavaloKategoria::TARTOS_TEJTERMEK->value  => KauflandTrierKategoria::HUTOS_UTAN,
            HozzavaloKategoria::AZSIAI->value            => KauflandTrierKategoria::HUTOS_UTAN,
            HozzavaloKategoria::UDITO->value             => KauflandTrierKategoria::UDITO,
        ];
    }
}
