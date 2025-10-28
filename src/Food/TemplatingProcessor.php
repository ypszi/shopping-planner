<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;

class TemplatingProcessor
{
    /**
     * @param array<string|string[]> $data
     *
     * @return array<string|string[]>
     */
    public function process(Food $food, array $data): array
    {
        return $this->processTemplate($food, $data);
    }

    /**
     * @param array<string|string[]> $rawData
     *
     * @return string[]
     */
    private function processTemplate(Food $food, array $rawData): array
    {
        $processedData = [];

        foreach ($rawData as $rawKey => $rawItem) {
            if (is_array($rawItem)) {
                $subItems     = $this->processTemplate($food, $rawItem);
                $processedKey = $rawKey;

                if (is_string($rawKey)) {
                    $processedKey = $this->replaceTemplateVariables(
                        $rawKey,
                        $this->findRelevantIngredients($rawKey, $food)
                    );
                }

                foreach ($subItems as $key => $subItem) {
                    $processedData[$processedKey][$key] = $subItem;
                }

                continue;
            }

            $processedData[$rawKey] = $this->replaceTemplateVariables(
                $rawItem,
                $this->findRelevantIngredients($rawItem, $food)
            );
        }

        return $processedData;
    }

    /**
     * @return array<IngredientForFood>
     */
    private function findRelevantIngredients(string $text, Food $food): array
    {
        return array_values(
            array_filter(
                $food->ingredients(),
                fn(
                    IngredientForFood $ingredientForFood
                ) => str_contains(
                         strtolower($text),
                         strtolower($ingredientForFood->name())
                     )
                     || (
                         $ingredientForFood->reference()
                         && str_contains(
                             strtolower($text),
                             strtolower($ingredientForFood->reference()->name())
                         )
                     )
            )
        );
    }

    /**
     * @param array<IngredientForFood> $relevantIngredients
     *
     * @return string
     */
    private function replaceTemplateVariables(string $text, array $relevantIngredients): string
    {
        $newText = $text;

        foreach ($relevantIngredients as $relevantIngredient) {
            $newText = preg_replace(
                pattern    : $this->placeholder($relevantIngredient->name()),
                replacement: $relevantIngredient->ingredientPortion(),
                subject    : $newText
            );

            if (!$relevantIngredient->reference()) {
                continue;
            }

            $newText = preg_replace(
                pattern    : $this->placeholder($relevantIngredient->reference()->name()),
                replacement: $relevantIngredient->ingredientPortion(),
                subject    : $newText
            );
        }

        return $newText;
    }

    private function placeholder(string $name): string
    {
        return sprintf('/\{\{\s?%s\s?\}\}/i', $this->escapeSpecialChars($name));
    }

    private function escapeSpecialChars(string $string): string
    {
        return rtrim(preg_replace('/(?!\w)/', '\\', $string), '\\');
    }
}
