<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Cukrasz\Cukor;
use PeterPecosz\Kajatervezo\Hozzavalo\Ecet\Ecet;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\So;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Szodabikarbona;
use PeterPecosz\Kajatervezo\Hozzavalo\Olaj\NapraforgoOlaj;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Liszt;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tejfol;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Vaj;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class CsorogeFank extends Etel
{
    public static function name(): string
    {
        return 'Csőröge Fánk';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Liszt(35, Mertekegyseg::DKG),
            new Vaj(1, Mertekegyseg::EK),
            new Cukor(1, Mertekegyseg::EK),
            new So(1, Mertekegyseg::CSIPET),
            new Tojas(4, Mertekegyseg::DB),
            new Tejfol(300, Mertekegyseg::G),
            new Szodabikarbona(1, Mertekegyseg::KK),
            new Ecet(1, Mertekegyseg::CSEPP),
            new NapraforgoOlaj(2, Mertekegyseg::DL),
        ];
    }

    public static function defaultAdag(): int
    {
        return 4;
    }

    public function rawReceptUrl(): string
    {
        return '';
    }

    public function thumbnailUrl(): string
    {
        return 'https://www.mindmegette.hu/images/369/Social/lead_Social_klasszikus-csoroge-fank-recept.jpg';
    }

    public function comments(): array
    {
        return [
            'A vajat belemorzsoljuk a lisztbe.',
            'Hozzáadjuk a cukrot és a sót.',
            'A tojássárgáját a tejföllel összekeverjük, majd hozzágyúrjuk a liszthez.',
            'Hozzáadjuk a szódabikarbónát és az ecetet.',
            'Az így kapott tésztát 1 órát pihentetjük.',
            'A kipihent tésztát kinyújtjuk és rombusz alakúra vágjuk.',
            'A rombuszra vágott tésztát formázzuk és olajban hirtelen kisütjük.',
        ];
    }
}
