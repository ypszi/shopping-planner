<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket;

use PeterPecosz\Kajatervezo\Hozzavalo\HozzavalokByKategoria;

interface Supermarket
{
    public static function name(): string;

    /**
     * @return string[]
     */
    public static function sorrend(): array;

    /**
     * @return array<string[]>
     */
    public function toShoppingList(HozzavalokByKategoria $hozzavalokByKategoria): array;
}
