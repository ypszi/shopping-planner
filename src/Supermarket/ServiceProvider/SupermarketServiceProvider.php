<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Supermarket\ServiceProvider;

use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;

use function DI\create;
use function DI\get;

class SupermarketServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            SupermarketFactory::class => create()
                ->constructor(get('config.supermarket.path')),
        ];
    }
}
