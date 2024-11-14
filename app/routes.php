<?php

/** phpcs:ignoreFile */

declare(strict_types=1);

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
    $app->get('/', ShoppingPlannerAction::class);
    $app->get('/planned', PlannedShoppingAction::class);
};
