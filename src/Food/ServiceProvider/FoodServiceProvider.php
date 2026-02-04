<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Core\Storage\ThumbnailExtensionStorage;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodsFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;

use function DI\autowire;
use function DI\create;
use function DI\get;

class FoodServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            FoodFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path'))
                ->constructorParameter('thumbnailFactory', get('foods.thumbnail_factory')),

            FoodsFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            AvailableFoodFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            AvailableFoodTagFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            'foods.thumbnail_factory' => autowire(ThumbnailFactory::class)
                ->constructorParameter('storage', get('foods.storage'))
                ->constructorParameter(
                    'thumbnailExtensionStorage',
                    create(ThumbnailExtensionStorage::class)
                        ->constructor(get('config.foods.path'))
                ),

            TemplatingProcessor::class => autowire(),
        ];
    }
}
