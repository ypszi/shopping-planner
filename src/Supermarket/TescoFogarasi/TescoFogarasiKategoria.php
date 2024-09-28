<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\TescoFogarasi;

use PeterPecosz\Kajatervezo\Hozzavalo\Kategoria;

enum TescoFogarasiKategoria: string implements Kategoria
{
    case ZOLDSEG_GYUMOLCS = 'Zöldség / Gyümölcs';
    case PEKARU = 'Pékárú';
    case FELVAGOTT = 'Felvágott';
    case SAJT = 'Sajt';
    case TEJTERMEK = 'Tejtermék';
    case HUS = 'Hús';
    case TARTOS_TEJTERMEK = 'Tartós tejtermék';
    case TESZTA_RIZS = 'Tészta / Rizs';
    case MIRELIT = 'Mirelit';
    case OLAJ_ECET = 'Olaj / Ecet';
    case KONZERV = 'Konzerv';
    case FUSZER = 'Fűszer';
    case CUKOR_LISZT_SUTEMENY = 'Cukor / Liszt / Sütemény';
    case MOGYORO_CHIPS_SNACKS = 'Mogyoró / Chips / Snacks';
    case EDESSEG_KEKSZ = 'Édesség / Keksz';
    case UDITO = 'Üditő';

    public function value(): string
    {
        return $this->value;
    }
}
