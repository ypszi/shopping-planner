<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionClass;
use RuntimeException;
use Slim\Interfaces\InvocationStrategyInterface;

class RequestResponseTypedArgs implements InvocationStrategyInterface
{
    private const SUPPORTED_SCALAR_TYPES = [
        'boolean',
        'bool',
        'integer',
        'int',
        'float',
        'double',
        'string',
        'array',
        'object',
        'null',
    ];

    public function __invoke(callable $callable, ServerRequestInterface $request, ResponseInterface $response, array $routeArguments): ResponseInterface
    {
        if (!is_array($callable)) {
            return $callable($request, $response, ...array_values($routeArguments)) ?? $response;
        }

        if (!is_object($callable[0])) {
            return $callable($request, $response, ...array_values($routeArguments)) ?? $response;
        }

        $actionReflection = new ReflectionClass($callable[0]);
        $actionParams     = $actionReflection->getMethod('__invoke')->getParameters();

        $typedRouteArguments = [];
        foreach ($actionParams as $actionParam) {
            $paramName = $actionParam->getName();
            $paramType = $actionParam->getType();

            if (
                !isset($routeArguments[$paramName])
                || !$paramType
            ) {
                continue;
            }

            $expectedParamType = $paramType->getName();
            if (!$this->isScalar($expectedParamType)) {
                throw new RuntimeException(sprintf('Non-scalar param type "%s" argument resolution  is not supported for: "%s"', $expectedParamType, $paramName));
            }

            $value = $routeArguments[$paramName];
            settype($value, $expectedParamType);
            $typedRouteArguments[$paramName] = $value;
        }

        return $callable($request, $response, ...array_values($typedRouteArguments)) ?? $response;
    }

    private function isScalar(string $type): bool
    {
        return in_array($type, self::SUPPORTED_SCALAR_TYPES, true);
    }
}
