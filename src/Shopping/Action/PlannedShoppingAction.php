<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Shopping\Action;

use PeterPecosz\ShoppingPlanner\Food\Factory\FoodsFactory;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class PlannedShoppingAction
{
    public function __construct(
        private SupermarketFactory $supermarketFactory,
        private FoodsFactory $foodsFactory,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $supermarket = $this->supermarketFactory->create($queryParams['supermarket']);

        $foodPortionsByFoodName = [];
        foreach ($queryParams as $key => $value) {
            if (str_contains($key, 'food-')) {
                $foodKey                           = str_replace('food-', '', $key);
                $foodName                          = str_replace('_', ' ', $foodKey);
                $foodPortionsByFoodName[$foodName] = (int)$queryParams['portion-' . $foodKey];
            }
        }

        $foods               = $this->foodsFactory->create($foodPortionsByFoodName);
        $shoppingList        = $supermarket->toShoppingList($foods)->filterEmptyColumns();
        $shoppingListByFood  = $supermarket->toShoppingListByFood($foods)->filterEmptyColumns();
        $totalRowCountByFood = array_sum(array_map(fn(array $rowsOfFood) => count($rowsOfFood), $shoppingListByFood->getRows()));

        $response->getBody()->write(
            $this->twig->render('planned-shopping.html.twig', [
                'supermarket'         => $supermarket,
                'foods'               => $foods,
                'shoppingList'        => $shoppingList,
                'shoppingListByFood'  => $shoppingListByFood,
                'totalRowCountByFood' => $totalRowCountByFood,
                'plannedShopping'     => http_build_query($queryParams),
            ])
        );

        return $response;
    }
}
