<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Url;

use PeterPecosz\ShoppingPlanner\Core\Exception\UnknownActionFound;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

readonly class UrlBuilder
{
    public function buildFor(ServerRequestInterface $request, string $routeActionName): string
    {
        $routeContext = RouteContext::fromRequest($request);

        if (!$routeContext->getRoute()) {
            throw new UnknownActionFound(sprintf('Route was not found by name: "%s"', $routeActionName));
        }

        return $routeContext
            ->getRouteParser()
            ->fullUrlFor($request->getUri(), $routeActionName);
    }
}
