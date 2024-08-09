<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum AuchanCsomorKategoria: string implements Kategoria
{
    case ZOLDSEG_GYUMOLCS = 'Zöldség / Gyümölcs';
    case HAL = 'Hal';
    case PEKARU = 'Pékárú';
    case MIRELIT = 'Mirelit';
    case TEJTERMEK = 'Tejtermék';
    case TARTOS_TEJTERMEK = 'Tartós tejtermék';
    case HUS = 'Hús';
    case FELVAGOTT = 'Felvágott';
    case EDESSEG = 'Édesség';
    case UDITO = 'Üditő';
    case NEMZETKOZI = 'Nemzetközi';
    case SOS_FUSZER = 'Sós, Fűszer';

    public function value(): string
    {
        return $this->value;
    }
}
