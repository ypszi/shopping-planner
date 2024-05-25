<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek;

use Override;

class MozzarellaSajtReszelt extends MozzarellaSajt
{
    #[Override] public static function name(): string
    {
        return parent::name() . ' (reszelt)';
    }
}
