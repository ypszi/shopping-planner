<?php

declare(strict_types=1);

return [
    'settings.display_error_details' => true,

    'cache.routes_cache.is_enabled'    => true,
    'cache.container_cache.is_enabled' => true,

    'twig.parameters' => [
        'cache' => __DIR__ . '/../../../var/cache/twig/',
    ],

    'config.foods.thumbnail_cache.path' => __DIR__ . '/../../../../foods/thumbnails/',
    'config.foods.thumbnail_asset.path' => 'foods/thumbnails/',

    'config.drugs.thumbnail_cache.path' => __DIR__ . '/../../../../drugs/thumbnails/',
    'config.drugs.thumbnail_asset.path' => 'drugs/thumbnails/',
];
