<?php

declare(strict_types=1);

use PeterPecosz\ShoppingPlanner\Core\Filename\LocalFileSystemFileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Core\Storage\LocalFileSystemStorage;

use function DI\create;
use function DI\get;

return [
    'settings.display_error_details' => true,

    'cache.routes_cache.is_enabled'    => false,
    'cache.container_cache.is_enabled' => false,

    'twig.parameters' => [],

    'config.foods.thumbnail_cache.path' => __DIR__ . '/../../../web/foods/thumbnails/',
    'config.foods.thumbnail_asset.path' => 'foods/thumbnails/',

    'foods.storage' => create(LocalFileSystemStorage::class)
        ->constructor(
            create(LocalFileSystemFileNameNormalizer::class),
            get('config.foods.thumbnail_cache.path'),
            get('config.foods.thumbnail_asset.path'),
        ),

    'config.drugs.thumbnail_cache.path' => __DIR__ . '/../../../web/drugs/thumbnails/',
    'config.drugs.thumbnail_asset.path' => 'drugs/thumbnails/',

    'drugs.storage' => create(LocalFileSystemStorage::class)
        ->constructor(
            create(LocalFileSystemFileNameNormalizer::class),
            get('config.drugs.thumbnail_cache.path'),
            get('config.drugs.thumbnail_asset.path'),
        ),
];
