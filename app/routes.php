<?php

/** phpcs:ignoreFile */

declare(strict_types=1);

use PeterPecosz\ShoppingPlanner\Ingredient\Action\GetIngredientStorageAction;
use PeterPecosz\ShoppingPlanner\Ingredient\Action\UpdateIngredientStorageAction;
use PeterPecosz\ShoppingPlanner\Shopping\Action\PlannedShoppingAction;
use PeterPecosz\ShoppingPlanner\Shopping\Action\ShoppingPlannerAction;
use Slim\App;

/**
 * Heads Up!
 * Slim does not support static closures.
 *
 * @see https://www.slimframework.com/docs/v4/objects/routing.html#closure-binding
 */
return function (App $app): void {
    $app->get('/', ShoppingPlannerAction::class)
        ->setName(ShoppingPlannerAction::class);
    $app->get('/planned', PlannedShoppingAction::class)
        ->setName(PlannedShoppingAction::class);
    $app->get('/storage/ingredients', GetIngredientStorageAction::class)
        ->setName(GetIngredientStorageAction::class);
    $app->post('/storage/ingredients', UpdateIngredientStorageAction::class)
        ->setName(UpdateIngredientStorageAction::class);
};
