<?php

declare(strict_types=1);

use DI\Container;
use Slim\App;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Handlers\ErrorHandler;
use Slim\Middleware\ErrorMiddleware;

return static function (App $app, Container $container): ErrorMiddleware {
    $errorHandler = new ErrorHandler(
        callableResolver: $app->getCallableResolver(),
        responseFactory:  $app->getResponseFactory()
    );

    $errorMiddleware = $app->addErrorMiddleware(
        displayErrorDetails: $container->get('settings.display_error_details'),
        logErrors:           false,
        logErrorDetails:     false
    );

    $errorMiddleware->setDefaultErrorHandler($errorHandler);
    $errorMiddleware->setErrorHandler(HttpNotFoundException::class, $errorHandler);
    $errorMiddleware->setErrorHandler(HttpMethodNotAllowedException::class, $errorHandler);

    return $errorMiddleware;
};
