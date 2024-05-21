<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\TartosElelmiszer;

use Override;

class VorosbabKonzerv extends Konzerv
{
    #[Override] public static function name(): string
    {
        return 'Vörösbab konzerv';
    }
}
