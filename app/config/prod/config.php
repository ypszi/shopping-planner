<?php

declare(strict_types=1);

use Aws\S3\S3Client;
use PeterPecosz\ShoppingPlanner\Core\File\S3FileNameNormalizer;
use PeterPecosz\ShoppingPlanner\Core\Storage\S3Storage;

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

    'foods.storage' => create(S3Storage::class)
        ->constructor(
            create(S3FileNameNormalizer::class),
            create(S3Client::class)
                ->constructor(
                    ['region' => getenv('AWS_REGION')]
                ),
            get('config.storage.s3.bucket'),
            get('config.storage.s3.region'),
            get('config.foods.thumbnail_cache.path'),
            get('config.foods.thumbnail_asset.path'),
        ),

    'config.drugs.thumbnail_cache.path' => 'thumbnails/drugs/',
    'config.drugs.thumbnail_asset.path' => 'thumbnails/drugs/',

    'drugs.storage' => create(S3Storage::class)
        ->constructor(
            create(S3FileNameNormalizer::class),
            create(S3Client::class)
                ->constructor(
                    ['region' => getenv('AWS_REGION')]
                ),
            get('config.storage.s3.bucket'),
            get('config.storage.s3.region'),
            get('config.drugs.thumbnail_cache.path'),
            get('config.drugs.thumbnail_asset.path'),
        ),

    'config.storage.s3.bucket' => getenv('S3_BUCKET'),
    'config.storage.s3.region' => getenv('AWS_REGION'),
];
