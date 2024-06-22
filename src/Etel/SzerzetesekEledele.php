<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Azsiai\Szojaszosz;
use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Etolaj;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\SzezamOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Kemenyito;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Brokkoli;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Gyomber;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\KinaiKel;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class SzerzetesekEledele extends Etel
{
    public static function name(): string
    {
        return 'Szerzetesek eledele';
    }

    protected function listHozzavalok(): array
    {
        return [
            // 50 g fafülgomba
            new Brokkoli(200, Mertekegyseg::G),
            new KinaiKel(100, Mertekegyseg::G),
            new Sargarepa(1, Mertekegyseg::DB),
            // 2 fej csiperkegomba (50 g/fej)
            new Gyomber(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Etolaj(2, Mertekegyseg::EK),
            new So(1, Mertekegyseg::TK),
            new Szojaszosz(2, Mertekegyseg::EK),
            new Bors(1, Mertekegyseg::MK),
            new Cukor(1, Mertekegyseg::MK),
            new Kemenyito(1, Mertekegyseg::EK),
            new SzezamOlaj(2, Mertekegyseg::TK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 2;
    }

    public function rawReceptUrl(): string
    {
        return 'https://streetkitchen.hu/azsiai-etelek/szerzetesek-eledele/';
    }
}
