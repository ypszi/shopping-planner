<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Hozzavalo\Zoldseg;

class SavanyuKaposzta extends Zoldseg
{
    #[\Override] public static function name(): string
    {
        return 'Savanyú káposzta';
    }
}
