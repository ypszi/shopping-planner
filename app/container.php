<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use PeterPecosz\ShoppingPlanner\Core\Environment;
use PeterPecosz\ShoppingPlanner\Core\ServiceProvider\CoreServiceProvider;
use PeterPecosz\ShoppingPlanner\Drug\ServiceProvider\DrugServiceProvider;
use PeterPecosz\ShoppingPlanner\Food\ServiceProvider\FoodServiceProvider;
use PeterPecosz\ShoppingPlanner\Ingredient\ServiceProvider\IngredientServiceProvider;
use PeterPecosz\ShoppingPlanner\Supermarket\ServiceProvider\SupermarketServiceProvider;

$commonConfig = array_merge(require __DIR__ . '/config/common/config.php', require __DIR__ . '/config/common/env.php');
$environment  = Environment::from($commonConfig['system.application.environment']);
$config       = require __DIR__ . "/config/$environment->value/config.php";
$builder      = new ContainerBuilder();

$builder->addDefinitions($commonConfig);
$builder->addDefinitions($config);
$builder->addDefinitions((new CoreServiceProvider())->getDefinitions());
$builder->addDefinitions((new IngredientServiceProvider())->getDefinitions());
$builder->addDefinitions((new FoodServiceProvider())->getDefinitions());
$builder->addDefinitions((new SupermarketServiceProvider())->getDefinitions());
$builder->addDefinitions((new DrugServiceProvider())->getDefinitions());

$builder->useAutowiring(true);
$builder->useAttributes(true);

if ($config['cache.container_cache.is_enabled']) {
    $containerCacheDir = __DIR__ . '/../var/cache/container';

    $builder->enableCompilation($containerCacheDir);
    $builder->writeProxiesToFile(true, $containerCacheDir);
}

return $builder->build();
