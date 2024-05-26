<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

class MozzarellaSajtReszelt extends MozzarellaSajt
{
    public static function name(): string
    {
        return parent::name() . ' (reszelt)';
    }
}
