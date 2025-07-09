<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\CookingSteps;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;

class CookingStepsProcessor
{
    public function process(Food $food): Food
    {
        $cookingSteps = [];

        foreach ($food->cookingSteps() as $cookingStep) {
            if (!is_string($cookingStep)) {
                $cookingSteps[] = $cookingStep;

                continue;
            }

            $relevantIngredients = $this->findRelevantIngredients($cookingStep, $food);

            $cookingSteps[] = $this->replaceTemplateVariables($cookingStep, $relevantIngredients);
        }

        return $food->withCookingSteps($cookingSteps);
    }

    /**
     * @return array<IngredientForFood>
     */
    private function findRelevantIngredients(string $cookingStep, Food $food): array
    {
        return array_values(
            array_filter(
                $food->ingredients(),
                fn(IngredientForFood $ingredientForFood) => str_contains(
                                                                strtolower($cookingStep),
                                                                strtolower($ingredientForFood->name())
                                                            )
                                                            || ($ingredientForFood->reference()
                                                                && str_contains(
                                                                    strtolower($cookingStep),
                                                                    strtolower($ingredientForFood->reference()->name())
                                                                ))
            )
        );
    }

    /**
     * @param string                   $cookingStep
     * @param array<IngredientForFood> $relevantIngredients
     *
     * @return string
     */
    private function replaceTemplateVariables(string $cookingStep, array $relevantIngredients): string
    {
        $newCookingStep = $cookingStep;

        foreach ($relevantIngredients as $relevantIngredient) {
            $newCookingStep = preg_replace(
                pattern    : $this->placeholder($relevantIngredient->name()),
                replacement: $relevantIngredient->ingredientPortion(),
                subject    : $newCookingStep
            );

            if (!$relevantIngredient->reference()) {
                continue;
            }

            $newCookingStep = preg_replace(
                pattern    : $this->placeholder($relevantIngredient->reference()->name()),
                replacement: $relevantIngredient->ingredientPortion(),
                subject    : $newCookingStep
            );
        }

        return $newCookingStep;
    }

    private function placeholder(string $name): string
    {
        return sprintf('/\{\{%s\}\}/i', $this->escapeSpecialChars($name));
    }

    private function escapeSpecialChars(string $string): string
    {
        return rtrim(preg_replace('/(?!\w)/', '\\', $string), '\\');
    }
}
