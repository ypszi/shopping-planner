<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Bor\VorosborSzaraz;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Baberlevel;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Bors;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Kakukkfu;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Rozmaring;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szerecsendio;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\OlivaOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\ParadicsomPure;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\SpagettiTeszta;
use PeterPecosz\Kajatervezo\Hozzavalo\HosszuSorok\WorcesterSzosz;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\DaraltHus;
use PeterPecosz\Kajatervezo\Hozzavalo\HutosUtan\Tej;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\ParmezanSajt;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Sargarepa;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Zellerszar;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class Bolognai extends Etel
{
    #[\Override] public static function name(): string
    {
        return 'Bolognai';
    }

    #[\Override] protected static function listHozzavalok(): array
    {
        return [
            new OlivaOlaj(3, Mertekegyseg::EK),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Sargarepa(0.5, Mertekegyseg::DB),
            new Zellerszar(2, Mertekegyseg::DB),
            new DaraltHus(500, Mertekegyseg::G),
            new VorosborSzaraz(150, Mertekegyseg::ML),
            new ParadicsomPure(250, Mertekegyseg::ML),
            new So(1, Mertekegyseg::EK),
            new Bors(1, Mertekegyseg::MK),
            new Szerecsendio(0.5, Mertekegyseg::MK),
            new Baberlevel(2, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new Kakukkfu(1, Mertekegyseg::CSIPET),
            new Rozmaring(1, Mertekegyseg::CSIPET),
            new WorcesterSzosz(1, Mertekegyseg::TK),
            // 3 dl víz
            new Tej(100, Mertekegyseg::ML),
            new SpagettiTeszta(400, Mertekegyseg::G),
            new ParmezanSajt(40, Mertekegyseg::G),
        ];
    }

    #[\Override] public static function defaultAdag(): int
    {
        return 4;
    }

    #[\Override] public function receptUrl(): string
    {
        return 'https://streetkitchen.hu/tesztapolc/ime-tokeletes-bolognai-spagetti/';
    }
}
