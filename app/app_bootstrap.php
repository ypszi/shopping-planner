<?php

declare(strict_types=1);

use DI\Container;
use PeterPecosz\ShoppingPlanner\Core\RequestResponseTypedArgs;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (Container $container): App {
    AppFactory::setContainer($container);

    $app = AppFactory::create($container->get(ResponseFactoryInterface::class));

    /**
     * Changing the default invocation strategy on the RouteCollector component
     * will change it for every route being defined after this change being applied
     */
    $routeCollector = $app->getRouteCollector();
    $routeCollector->setDefaultInvocationStrategy(new RequestResponseTypedArgs());

    if ($container->get('cache.routes_cache.is_enabled')) {
        $cacheDir  = __DIR__ . '/../var/cache/routes';
        $cacheFile = $cacheDir . '/routes_cache.php';

        if (!is_dir($cacheDir)) {
            mkdir(directory: $cacheDir, permissions: 0755, recursive: true);
        }

        $routeCollector->setCacheFile($cacheFile);
    }

    return $app;
};
