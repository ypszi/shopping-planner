<?php

declare(strict_types=1);

return [
    'settings.display_error_details' => true,

    'cache.routes_cache.is_enabled'    => false,
    'cache.container_cache.is_enabled' => false,

    'twig.parameters' => [],

    'config.foods.thumbnail_cache.path' => __DIR__ . '/../../../web/foods/thumbnails/',
    'config.foods.thumbnail_asset.path' => 'foods/thumbnails/',

    'config.drugs.thumbnail_cache.path' => __DIR__ . '/../../../web/drugs/thumbnails/',
    'config.drugs.thumbnail_asset.path' => 'drugs/thumbnails/',
];
