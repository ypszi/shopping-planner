<?php

declare(strict_types=1);

use PeterPecosz\ShoppingPlanner\Core\Environment;

return [
    'system.application.environment' => Environment::dev->value,
];
