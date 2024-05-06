<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;

class KauflandTrier implements Supermarket
{
    public static function name(): string
    {
        return 'Kaufland - Trier';
    }

    public function createHozzavaloSorok(Etelek $etelek): HozzavaloSorok
    {
        $hozzavaloSorok = new HozzavaloSorok();

        foreach ($etelek as $etel) {
            foreach ($etel->hozzavalok() as $hozzavalo) {
                $hozzavaloSorok->addHozzavalo($hozzavalo);
            }
        }

        return $hozzavaloSorok->sort();
    }
}
