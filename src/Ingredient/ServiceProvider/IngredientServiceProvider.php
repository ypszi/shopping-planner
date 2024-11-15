<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Mapper\IngredientFileMapper;

use function DI\autowire;
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

            IngredientFileMapper::class => autowire()
                ->constructorParameter('ingredientStoragePath', get('config.ingredients_storage.path')),
        ];
    }
}
