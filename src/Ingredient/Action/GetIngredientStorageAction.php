<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Action;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientMeasureMap;
use PeterPecosz\ShoppingPlanner\Ingredient\Service\IngredientStorageService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class GetIngredientStorageAction
{
    public function __construct(
        private IngredientStorageService $ingredientStorageService,
        private IngredientMeasureMap $ingredientMeasureMap,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $ingredientStorage = $this->ingredientStorageService->getIngredientStorage();

        $response->getBody()->write(
            $this->twig->render('ingredients.html.twig', [
                'ingredientStorage'              => $ingredientStorage,
                'ingredientMeasureMapByName'     => $this->ingredientMeasureMap->mapByName(),
                'ingredientMeasureMapByCategory' => $this->ingredientMeasureMap->mapByCategory(),
            ])
        );

        return $response;
    }
}
