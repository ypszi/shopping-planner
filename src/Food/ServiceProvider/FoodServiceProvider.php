<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food\ServiceProvider;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodsFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;

use function DI\autowire;
use function DI\create;
use function DI\get;

class FoodServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            FoodFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            FoodsFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            AvailableFoodFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            AvailableFoodTagFactory::class => autowire()
                ->constructorParameter('foodsPath', get('config.foods.path')),

            ThumbnailFactory::class => autowire()
                ->constructorParameter(
                    'httpClient',
                    create(Client::class)
                        ->constructor(
                            [
                                RequestOptions::ALLOW_REDIRECTS => true,
                            ]
                        )
                )
                ->constructorParameter('thumbnailWebPath', get('config.foods.thumbnail_asset.path'))
                ->constructorParameter('thumbnailCachePath', get('config.foods.thumbnail_cache.path')),
        ];
    }
}
