<?php

declare(strict_types=1);

return [
    'config.supermarket.path'          => __DIR__ . '/../../supermarkets.yaml',
    'config.foods.path'                => __DIR__ . '/../../foods.yaml',
    'config.ingredients.path'          => __DIR__ . '/../../ingredients.yaml',
    'config.ingredientCategories.path' => __DIR__ . '/../../ingredientCategories.yaml',
    'config.ingredients_storage.path'  => __DIR__ . '/../../../var/cache/ingredientStorage.yaml',

    'twig.template_path' => __DIR__ . '/../../../src/templates',
];
