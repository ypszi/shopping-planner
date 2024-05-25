<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use Override;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Baberlevel;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\Fuszerkomeny;
use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\FuszerPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Finomliszt;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\Rizs;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\DaraltHus;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Kolbasz;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\KolozsvariSzalonna;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Serteszsir;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Fokhagyma;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Kaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\SavanyuKaposzta;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class ToltottKaposzta extends Etel
{
    #[Override] public static function name(): string
    {
        return 'Töltött káposzta';
    }

    #[Override] protected function listHozzavalok(): array
    {
        return [
            new SavanyuKaposzta(1, Mertekegyseg::KG),
            new Kaposzta(1, Mertekegyseg::DB),
            new Voroshagyma(1, Mertekegyseg::DB),
            new Fokhagyma(2, Mertekegyseg::GEREZD),
            new FuszerPaprika(3, Mertekegyseg::TK),
            new Fuszerkomeny(1, Mertekegyseg::TK),
            new Baberlevel(5, Mertekegyseg::DB),
            new Rizs(20, Mertekegyseg::DKG),
            new Finomliszt(1, Mertekegyseg::EK),
            new DaraltHus(50, Mertekegyseg::DKG),
            new KolozsvariSzalonna(20, Mertekegyseg::DKG),
            new Kolbasz(20, Mertekegyseg::DKG),
            new Serteszsir(1, Mertekegyseg::EK),
        ];
    }

    #[Override] public static function defaultAdag(): int
    {
        return 8;
    }

    #[Override] public function receptUrl(): string
    {
        return $this->decorateNoSaltyReceptUrl('https://www.nosalty.hu/recept/klasszikus-toltott-kaposzta');
    }
}
