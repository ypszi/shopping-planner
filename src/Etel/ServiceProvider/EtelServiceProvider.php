<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel\ServiceProvider;

use PeterPecosz\Kajatervezo\Core\ServiceProvider\ServiceDefinitionProviderInterface;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelekFactory;

use function DI\create;
use function DI\get;

class EtelServiceProvider implements ServiceDefinitionProviderInterface
{
    public function getDefinitions(): array
    {
        return [
            EtelekFactory::class => create()
                ->constructor(
                    get('config.foods.path'),
                    get('config.ingredients.path'),
                    get('config.ingredientCategories.path')
                ),
        ];
    }
}
