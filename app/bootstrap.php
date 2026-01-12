<?php

declare(strict_types=1);

use DI\Container;
use Slim\App;
use Symfony\Component\Dotenv\Dotenv;

try {
    (static function (): void {
        require __DIR__ . '/../vendor/autoload.php';

        if (getenv('APP_ENV') !== 'prod') {
            $dotenv = new Dotenv();
            $dotenv
                ->usePutenv()
                ->load(__DIR__ . '/../.env');
        }

        /** @var Container $container */
        $container = require __DIR__ . '/container.php';

        /** @var App $app */
        $app = (require __DIR__ . '/app_bootstrap.php')($container);

        (require __DIR__ . '/routes.php')($app, $container);

        /**
         * The routing middleware should be added earlier than the ErrorMiddleware
         * Otherwise exceptions thrown from it will not be handled by the middleware
         *
         * see https://www.slimframework.com/docs/v4/middleware/routing.html
         *
         * see https://www.slimframework.com/docs/v4/concepts/middleware.html#how-does-middleware-work
         */
        $app->addRoutingMiddleware();

        /**
         * Note: This middleware should be added last. It will not handle any exceptions/errors
         * for middleware added after it.
         *
         * see https://www.slimframework.com/docs/v4/middleware/error-handling.html#usage
         */
        (require __DIR__ . '/error_middleware_bootstrap.php')($app, $container);

        unset($container);

        $app->run();
    })();
} catch (Throwable $e) {
    echo 'Bootstrap error occurred: ' . $e->getMessage();
    exit(255);
}
