<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use PeterPecosz\Kajatervezo\Core\Environment;
use PeterPecosz\Kajatervezo\Core\ServiceProvider\CoreServiceProvider;
use PeterPecosz\Kajatervezo\Etel\ServiceProvider\EtelServiceProvider;
use PeterPecosz\Kajatervezo\Supermarket\ServiceProvider\SupermarketServiceProvider;

$commonConfig = require __DIR__ . '/config/common/config.php';
$environment  = Environment::from($commonConfig['system.application.environment']);
$config       = require __DIR__ . "/config/$environment->value/config.php";
$builder      = new ContainerBuilder();

$builder->addDefinitions($commonConfig);
$builder->addDefinitions($config);
$builder->addDefinitions((new CoreServiceProvider())->getDefinitions());
$builder->addDefinitions((new EtelServiceProvider())->getDefinitions());
$builder->addDefinitions((new SupermarketServiceProvider())->getDefinitions());

$builder->useAutowiring(true);
$builder->useAttributes(true);

if ($config['cache.container_cache.is_enabled']) {
    $containerCacheDir = __DIR__ . '/../var/cache/container';

    $builder->enableCompilation($containerCacheDir);
    $builder->writeProxiesToFile(true, $containerCacheDir);
}

return $builder->build();
