<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodsFactory;

use function DI\autowire;
use function DI\create;
use function DI\get;

class FoodServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            FoodFactory::class => create()
                ->constructor(get('config.foods.path')),

            AvailableFoodFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            AvailableFoodTagFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            FoodsFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),
        ];
    }
}
