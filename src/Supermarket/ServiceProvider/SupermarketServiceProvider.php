<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Supermarket\ServiceProvider;

use PeterPecosz\Kajatervezo\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;

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
