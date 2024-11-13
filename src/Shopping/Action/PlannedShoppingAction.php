<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Shopping\Action;

use PeterPecosz\Kajatervezo\Etel\Factory\EtelekFactory;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class PlannedShoppingAction
{
    public function __construct(
        private SupermarketFactory $supermarketFactory,
        private EtelekFactory $etelekFactory,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $plannedShopping = $request->getQueryParams();

        unset($plannedShopping['planned']);

        $supermarket = $this->supermarketFactory->create($plannedShopping['supermarket']);

        $foodPortionsByFoodName = [];
        foreach ($plannedShopping as $key => $value) {
            if (str_contains($key, 'food-')) {
                $foodKey                           = str_replace('food-', '', $key);
                $foodName                          = str_replace('_', ' ', $foodKey);
                $foodPortionsByFoodName[$foodName] = (int)$plannedShopping['portion-' . $foodKey];
            }
        }

        $etelek              = $this->etelekFactory->create($foodPortionsByFoodName);
        $shoppingList        = $supermarket->toShoppingList($etelek)->filterEmptyColumns();
        $shoppingListByFood  = $supermarket->toShoppingListByFood($etelek)->filterEmptyColumns();
        $totalRowCountByFood = array_sum(array_map(fn(array $rowsOfFood) => count($rowsOfFood), $shoppingListByFood->getRows()));

        $response->getBody()->write(
            $this->twig->render('planned-shopping.html.twig', [
                'supermarket'         => $supermarket,
                'etelek'              => $etelek,
                'shoppingList'        => $shoppingList,
                'shoppingListByFood'  => $shoppingListByFood,
                'totalRowCountByFood' => $totalRowCountByFood,
                'plannedShopping'     => http_build_query($plannedShopping),
            ])
        );

        return $response;
    }
}
