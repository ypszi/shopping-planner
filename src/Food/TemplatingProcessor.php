<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use RuntimeException;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class TemplatingProcessor
{
    /** @var array<string, float[]> */
    private array $processedIngredients = [];

    public function __construct(private readonly ExpressionLanguage $expressionLanguage)
    {
    }

    /**
     * @param array<string|string[]> $data
     *
     * @return array<string|string[]>
     */
    public function process(Food $food, array $data): array
    {
        $this->processedIngredients = [];
        $result                     = $this->processTemplate($food, $data);

        $totalByIngredients = array_map(
            fn(array $portions) => array_sum($portions),
            $this->processedIngredients
        );

        foreach ($food->ingredients() as $ingredient) {
            if (!isset($totalByIngredients[$ingredient->name()])) {
                // ingredient was not found in template

                continue;
            }

            $remainder = fmod($totalByIngredients[$ingredient->name()], $ingredient->portion());

            if ($remainder) {
                throw new RuntimeException(
                    sprintf(
                        'Total does not add up for: "%s"; expected "%.2f", got "%.2f"',
                        $ingredient->name(),
                        $ingredient->portion(),
                        $totalByIngredients[$ingredient->name()],
                    )
                );
            }
        }

        return $result;
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
            $newText = preg_replace_callback(
                pattern : $this->placeholderWithOptionalMath($relevantIngredient->name()),
                callback: $this->createReplacementCallback($relevantIngredient),
                subject : $newText
            );

            if (!$relevantIngredient->reference()) {
                continue;
            }

            $newText = preg_replace_callback(
                pattern : $this->placeholderWithOptionalMath($relevantIngredient->reference()->name()),
                callback: $this->createReplacementCallback($relevantIngredient),
                subject : $newText
            );
        }

        return $newText;
    }

    private function placeholderWithOptionalMath(string $name): string
    {
        return sprintf(
            '/\{\{\s?(?<ingredirent>%s)\s?(?<expression>(?<operand>[+\-\/*])\s?(?<operator>\d+\.?\d*))?\s?\}\}/i',
            $this->escapeSpecialChars($name)
        );
    }

    private function escapeSpecialChars(string $string): string
    {
        return rtrim(preg_replace('/(?!\w)/', '\\', $string), '\\');
    }

    private function createReplacementCallback(IngredientForFood $ingredient): callable
    {
        return function ($matches) use ($ingredient) {
            /** @var array{ingredient: string, expression: string, operand: string, operator: string} $matches */

            $capturedExpression = $matches['expression'] ?? null;

            if (!$capturedExpression) {
                $this->processedIngredients[$ingredient->name()][] = $ingredient->portion();

                return $ingredient->ingredientPortion();
            }

            $expression = 'portion ' . trim((string)$capturedExpression);

            $originalPortion    = $ingredient->portion();
            $newPortion         = $this->evaluateMathExpression($originalPortion, $expression);
            $adjustedIngredient = $ingredient->withPortion($newPortion);

            $this->processedIngredients[$ingredient->name()][] = $adjustedIngredient->portion();

            return $adjustedIngredient->ingredientPortion();
        };
    }

    private function evaluateMathExpression(float $portion, string $expression): float
    {
        return (float)$this->expressionLanguage->evaluate($expression, ['portion' => $portion]);
    }
}
