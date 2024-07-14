<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Fuszer\PirosPaprika;
use PeterPecosz\Kajatervezo\Hozzavalo\Hus\Sertescomb;
use PeterPecosz\Kajatervezo\Hozzavalo\Mirelit\ZoldbabMirelit;
use PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer\ParadicsomPure;
use PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg\Voroshagyma;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;

class GorogBab extends Etel
{
    public static function name(): string
    {
        return 'Görög bab';
    }

    protected function listHozzavalok(): array
    {
        return [
            new Voroshagyma(4, Mertekegyseg::DB),
            new Sertescomb(60, Mertekegyseg::DKG),
            new ZoldbabMirelit(2, Mertekegyseg::KG),
            new PirosPaprika(1, Mertekegyseg::TK),
            new ParadicsomPure(3, Mertekegyseg::TK),
        ];
    }

    public static function defaultAdag(): int
    {
        return 6;
    }

    public function rawReceptUrl(): string
    {
        return '';
    }

    public function comments(): array
    {
        return [
            'A hagymát apróra vágjuk, a húst felkockázzuk.',
            'A hagymát kevés olajon üvegesre pároljuk.',
            'Hozzákeverjük a paradicsom pürét.',
            'Majd beletesszük a húst és fehéredésig főzzük.',
            'Tűzről lehúzva piros paprikával ízesítjük.',
            'Utána 2 adagban vizet teszünk hozzá, hogy szaftja legyen (kb 2x1 dl)',
            'Ebbe tesszük bele a babot, majd vizet töltünk hozzá és felforraljuk (kevés víz is elég, mert ha a víz ellepi, leveses lesz).',
            'Addig főzzük kis lángon, amíg a bab és hús megpuhul.',
            ...parent::comments(),
        ];
    }
}
