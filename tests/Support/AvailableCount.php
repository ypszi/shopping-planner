<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Support;

use Symfony\Component\Yaml\Yaml;

final class AvailableCount
{
    private static ?int $foodCount = null;

    private static ?int $drugCount = null;

    private function __construct()
    {
    }

    public static function getFoodCount(): int
    {
        if (!isset(self::$foodCount)) {
            self::$foodCount = count(Yaml::parseFile(Resource::Foods->value));
        }

        return self::$foodCount;
    }

    public static function getDrugCount(): int
    {
        if (!isset(self::$drugCount)) {
            self::$drugCount = count(Yaml::parseFile(Resource::Drugs->value));
        }

        return self::$drugCount;
    }
}
