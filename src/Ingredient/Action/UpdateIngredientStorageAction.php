<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Action;

use Fig\Http\Message\StatusCodeInterface;
use PeterPecosz\ShoppingPlanner\Ingredient\Mapper\IngredientFileMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Twig\Environment;

readonly class UpdateIngredientStorageAction
{
    public function __construct(
        private IngredientFileMapper $ingredientFileMapper,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $ingredients          = [];
        $availableIngredients = $this->ingredientFileMapper->save($ingredients);

        $response->getBody()->write(
            $this->twig->render('ingredients.html.twig', [
                'availableIngredients' => $availableIngredients,
            ])
        );

        return $response
            ->withHeader(
                'Location',
                RouteContext::fromRequest($request)
                    ->getRouteParser()
                    ->relativeUrlFor(GetIngredientStorageAction::class)
            )
            ->withStatus(StatusCodeInterface::STATUS_FOUND);
    }
}
