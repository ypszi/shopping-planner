<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug\ServiceProvider;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Drug\Factory\AvailableDrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\ThumbnailFactory;

use function DI\autowire;
use function DI\create;
use function DI\get;

class DrugServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            DrugFactory::class => create()
                ->constructor(
                    get('config.drugs.path'),
                    get('config.drugCategories.path'),
                    get('drugs.thumbnail_factory'),
                ),

            AvailableDrugFactory::class => autowire()
                ->constructorParameter('drugsPath', get('config.drugs.path')),

            DrugsFactory::class => autowire()
                ->constructorParameter('drugsPath', get('config.drugs.path')),

            'drugs.thumbnail_factory' => create(ThumbnailFactory::class)
                ->constructor(
                    create(Client::class)
                        ->constructor(
                            [
                                RequestOptions::ALLOW_REDIRECTS => true,
                            ]
                        ),
                    get('drugs.storage')
                ),

        ];
    }
}
