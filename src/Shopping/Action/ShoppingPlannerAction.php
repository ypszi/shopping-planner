<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Shopping\Action;

use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Action\GetIngredientStorageAction;
use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Twig\Environment;

readonly class ShoppingPlannerAction
{
    public function __construct(
        private SupermarketFactory $supermarketFactory,
        private AvailableFoodFactory $availableFoodFactory,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $availableSupermarkets = array_combine(
            range(1, count($this->supermarketFactory->listAvailableSupermarkets())),
            array_values($this->supermarketFactory->listAvailableSupermarkets())
        );

        $queryParams        = $request->getQueryParams();
        $defaultSupermarket = $queryParams['supermarket'] ?? Supermarket::DEFAULT;
        $availableFoods     = $this->availableFoodFactory->listAvailableFoods();
        $selectedFoods      = $this->getSelectedFoods($request);

        $response->getBody()->write(
            $this->twig->render('shopping-planner.html.twig', [
                'defaultSupermarket'    => $defaultSupermarket,
                'availableSupermarkets' => $availableSupermarkets,
                'availableFoods'        => $availableFoods,
                'selectedFoods'         => $selectedFoods,
                'ingredientStorageUrl'  => RouteContext::fromRequest($request)->getRouteParser()->fullUrlFor($request->getUri(), GetIngredientStorageAction::class),
            ])
        );

        return $response;
    }

    /**
     * @return array<string, int>
     */
    private function getSelectedFoods(ServerRequestInterface $request): array
    {
        $queryParams   = $request->getQueryParams();
        $foods         = array_filter($queryParams, fn(string $key) => str_contains($key, 'food-'), ARRAY_FILTER_USE_KEY);
        $portions      = array_filter($queryParams, fn(string $key) => str_contains($key, 'portion-'), ARRAY_FILTER_USE_KEY);
        $selectedFoods = [];

        foreach ($foods as $key => $value) {
            $portionKey            = str_replace('food-', 'portion-', $key);
            $selectedFoods[$value] = $portions[$portionKey];
        }

        return $selectedFoods;
    }
}