<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use Override;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;

class KauflandTrier extends Supermarket
{
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
            KauflandTrierKategoria::ZOLDSEG_GYUMOLCS->value,
            KauflandTrierKategoria::FUSZER_ES_OLAJ->value,
            KauflandTrierKategoria::HOSSZU_SOROK->value,
            KauflandTrierKategoria::HUS->value,
            KauflandTrierKategoria::HUTOS->value,
            KauflandTrierKategoria::HUTOS_UTAN->value,
            KauflandTrierKategoria::UDITO->value,
        ];
    }
}
