<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Measure\Conversion;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Conversion\Exception\UnknownUnitOfMeasureException;

readonly class MeasureConversionCollection
{
    /**
     * @param MeasureConversion[] $elements
     */
    public function __construct(private array $elements)
    {
    }

    /**
     * @throws UnknownUnitOfMeasureException
     */
    public function get(IngredientForFood $ingredient, IngredientForFood $addedIngredient): MeasureConversion
    {
        foreach ($this->elements as $element) {
            if ($element->canConvert($ingredient, $addedIngredient)) {
                return $element;
            }
        }

        throw new UnknownUnitOfMeasureException(sprintf('Cannot convert %s to %s', $ingredient, $addedIngredient));
    }
}
