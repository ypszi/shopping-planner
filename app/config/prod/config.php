<?php

declare(strict_types=1);

use PeterPecosz\ShoppingPlanner\Core\Filename\LocalFileSystemFileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Core\Storage\LocalFileSystemStorage;

use function DI\create;
use function DI\get;

return [
    'settings.display_error_details' => true,

    'cache.routes_cache.is_enabled' => true,
    'cache.routes_cache.path'       => '/tmp/var/cache/routes',

    'cache.container_cache.is_enabled' => true,
    'cache.container_cache.path'       => '/tmp/var/cache/container',

    'twig.parameters' => [
        'cache' => '/tmp/var/cache/twig/',
    ],

    'config.foods.thumbnail_cache.path' => 'thumbnails/foods/',
    'config.foods.thumbnail_asset.path' => 'thumbnails/foods/',

    'foods.storage' => create(LocalFileSystemStorage::class)
        ->constructor(
            create(LocalFileSystemFileNameNormalizer::class),
            get('config.foods.thumbnail_cache.path'),
            get('config.foods.thumbnail_asset.path'),
        ),

    'config.drugs.thumbnail_cache.path' => 'thumbnails/drugs/',
    'config.drugs.thumbnail_asset.path' => 'thumbnails/drugs/',

    'drugs.storage' => create(LocalFileSystemStorage::class)
        ->constructor(
            create(LocalFileSystemFileNameNormalizer::class),
            get('config.drugs.thumbnail_cache.path'),
            get('config.drugs.thumbnail_asset.path'),
        ),
];
