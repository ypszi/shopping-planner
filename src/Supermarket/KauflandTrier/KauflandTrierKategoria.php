<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\KauflandTrier;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum KauflandTrierKategoria: string implements Kategoria
{
    case ZOLDSEG_GYUMOLCS = 'Zöldség / Gyümölcs';
    case FUSZER_ES_OLAJ = 'Fűszer és Olaj';
    case HOSSZU_SOROK = 'Hosszú sorok';
    case HUS = 'Hús';
    case HUTOS = 'Hűtős';
    case HUTOS_UTAN = 'Hűtős után';
    case UDITO = 'Üditő';

    #[Override] public function value(): string
    {
        return $this->value;
    }
}
