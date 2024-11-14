<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientFactory;

use function DI\create;
use function DI\get;

class IngredientServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            IngredientFactory::class => create()
                ->constructor(
                    get('config.ingredients.path'),
                    get('config.ingredientCategories.path')
                ),
        ];
    }
}
