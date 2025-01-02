<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Drug\Factory\AvailableDrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugsFactory;

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
                    get('config.drugCategories.path')
                ),

            AvailableDrugFactory::class => autowire()
                ->constructorParameter('drugsPath', get('config.drugs.path')),

            DrugsFactory::class => autowire()
                ->constructorParameter('drugsPath', get('config.drugs.path')),

        ];
    }
}
