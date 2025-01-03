<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Supermarket\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;

use function DI\autowire;
use function DI\get;

class SupermarketServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            SupermarketFactory::class => autowire()
                ->constructorParameter('supermarketsPath', get('config.supermarket.path')),
        ];
    }
}
