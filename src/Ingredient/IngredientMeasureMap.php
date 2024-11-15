<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient;

use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;

final class IngredientMeasureMap
{
    /** @var array<string, array{max: int, step: int}> */
    public array $map;

    public function __construct()
    {
        foreach (Measure::cases() as $measure) {
            $this->map[$measure->value] = match ($measure) {
                Measure::DB => [
                    'max'  => 30,
                    'step' => 1,
                ],
                Measure::GEREZD => [
                    'max'  => 50,
                    'step' => 5,
                ],
                Measure::KONZERV,
                Measure::CSOMAG => [
                    'max'  => 5,
                    'step' => 1,
                ],
                Measure::DKG => [
                    'max'  => 50,
                    'step' => 5,
                ],
                Measure::KG => [
                    'max'  => 5,
                    'step' => 1,
                ],
                Measure::G,
                Measure::ML => [
                    'max'  => 10000,
                    'step' => 100,
                ],
                Measure::CL => [
                    'max'  => 1000,
                    'step' => 10,
                ],
                Measure::DL => [
                    'max'  => 100,
                    'step' => 1,
                ],
                Measure::L => [
                    'max'  => 10,
                    'step' => 1,
                ],
                Measure::CSESZE,
                Measure::BOGRE,
                Measure::MK,
                Measure::KK,
                Measure::TK,
                Measure::KVK,
                Measure::EK => [
                    'max'  => 50,
                    'step' => 1,
                ],
                default => [
                    'max'  => 20,
                    'step' => 1,
                ],
            };
        }
    }
}
