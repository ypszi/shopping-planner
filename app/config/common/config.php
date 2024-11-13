<?php

declare(strict_types=1);

use PeterPecosz\Kajatervezo\Core\Environment;

return [
    'system.application.environment' => Environment::dev->value,

    'config.supermarket.path'          => __DIR__ . '/../../supermarkets.yaml',
    'config.foods.path'                => __DIR__ . '/../../foods.yaml',
    'config.ingredients.path'          => __DIR__ . '/../../ingredients.yaml',
    'config.ingredientCategories.path' => __DIR__ . '/../../ingredientCategories.yaml',

    'twig.template_path' => __DIR__ . '/../../../src/templates',
];
