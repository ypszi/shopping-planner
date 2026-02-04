<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Support;

enum Resource: string
{
    case Foods = __DIR__ . '/../../app/foods.yaml';
    case Ingredients = __DIR__ . '/../../app/ingredients.yaml';
    case IngredientCategories = __DIR__ . '/../../app/ingredientCategories.yaml';
    case Drugs = __DIR__ . '/../../app/drugs.yaml';
    case DrugCategories = __DIR__ . '/../../app/drugCategories.yaml';
    case Supermarkets = __DIR__ . '/../../app/supermarkets.yaml';
}
