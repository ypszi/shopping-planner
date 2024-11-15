<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Action;

use Fig\Http\Message\StatusCodeInterface;
use PeterPecosz\ShoppingPlanner\Ingredient\Factory\IngredientFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Mapper\IngredientFileMapper;
use PeterPecosz\ShoppingPlanner\Mertekegyseg\Measure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;

readonly class UpdateIngredientStorageAction
{
    public function __construct(
        private IngredientFactory $ingredientFactory,
        private IngredientFileMapper $ingredientFileMapper
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        foreach ($this->getSelectedIngredients($request) as $selectedIngredientName => $selectedIngredient) {
            $ingredients[] = $this->ingredientFactory->createWithPortion(
                ingredientName: $selectedIngredientName,
                portion:        $selectedIngredient['portion'],
                measure:        Measure::from($selectedIngredient['measure'])
            );
        }

        $this->ingredientFileMapper->save($ingredients);

        return $response
            ->withHeader(
                'Location',
                RouteContext::fromRequest($request)
                    ->getRouteParser()
                    ->relativeUrlFor(GetIngredientStorageAction::class)
            )
            ->withStatus(StatusCodeInterface::STATUS_FOUND);
    }

    /**
     * @return array<string, array{portion: float, measure: string}>
     */
    private function getSelectedIngredients(ServerRequestInterface $request): array
    {
        $requestBody         = $request->getParsedBody();
        $ingredients         = array_filter($requestBody, fn(string $key) => str_contains($key, 'ingredient-'), ARRAY_FILTER_USE_KEY);
        $portions            = array_filter($requestBody, fn(string $key) => str_contains($key, 'portion-'), ARRAY_FILTER_USE_KEY);
        $measures            = array_filter($requestBody, fn(string $key) => str_contains($key, 'measure-'), ARRAY_FILTER_USE_KEY);
        $selectedIngredients = [];

        foreach ($ingredients as $key => $value) {
            $portionKey = str_replace('ingredient-', 'portion-', $key);
            $measureKey = str_replace('ingredient-', 'measure-', $key);

            $selectedIngredients[$value] = [
                'portion' => (float)$portions[$portionKey],
                'measure' => $measures[$measureKey],
            ];
        }

        return $selectedIngredients;
    }
}
