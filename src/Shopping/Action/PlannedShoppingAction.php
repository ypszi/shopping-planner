<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Shopping\Action;

use PeterPecosz\ShoppingPlanner\Core\Url\UrlBuilder;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugShoppingListFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\FoodsFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Action\GetIngredientStorageAction;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class PlannedShoppingAction
{
    public function __construct(
        private SupermarketFactory $supermarketFactory,
        private FoodsFactory $foodsFactory,
        private DrugShoppingListFactory $drugShoppingListFactory,
        private UrlBuilder $urlBuilder,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $queryParams                  = $request->getQueryParams();
        $portionsByFoodName           = $this->createPortionsByFoodName($request);
        $portionsByDrugName           = $this->createPortionsByDrugName($request);
        $foods                        = $this->foodsFactory->create($portionsByFoodName);
        $supermarket                  = $this->supermarketFactory->create($queryParams['supermarket']);
        $unfilteredShoppingList       = $supermarket->toShoppingList($foods);
        $shoppingList                 = $unfilteredShoppingList->filterEmptyColumns();
        $unfilteredShoppingListByFood = $supermarket->toShoppingListByFood($foods);
        $shoppingListByFood           = $unfilteredShoppingListByFood->filterEmptyColumns();
        $drugShoppingList             = $this->drugShoppingListFactory->create($portionsByDrugName);
        $totalRowCountByFood          = array_sum(array_map(fn(array $rowsOfFood) => count($rowsOfFood), $unfilteredShoppingListByFood->getRows()));

        $response->getBody()->write(
            $this->twig->render(
                'planned-shopping.html.twig',
                [
                    'supermarket'                  => $supermarket,
                    'portionsByFoodName'           => $portionsByFoodName,
                    'foods'                        => $foods,
                    'unfilteredShoppingList'       => $unfilteredShoppingList,
                    'shoppingList'                 => $shoppingList,
                    'unfilteredShoppingListByFood' => $unfilteredShoppingListByFood,
                    'shoppingListByFood'           => $shoppingListByFood,
                    'drugShoppingList'             => $drugShoppingList,
                    'totalRowCountByFood'          => $totalRowCountByFood,
                    'plannedShopping'              => http_build_query($queryParams),
                    'ingredientStorageUrl'         => $this->urlBuilder->buildFor($request, GetIngredientStorageAction::class),
                ],
            )
        );

        return $response;
    }

    /**
     * @return array<string, int>
     */
    private function createPortionsByFoodName(ServerRequestInterface $request): array
    {
        $queryParams            = $request->getQueryParams();
        $foodPortionsByFoodName = [];

        foreach ($queryParams as $key => $value) {
            if (str_contains($key, 'food-')) {
                $foodKey                           = str_replace('food-', '', $key);
                $foodName                          = str_replace('_', ' ', $foodKey);
                $foodPortionsByFoodName[$foodName] = (int)$queryParams['portion-' . $foodKey];
            }
        }

        return $foodPortionsByFoodName;
    }

    /**
     * @return array<string, int>
     */
    private function createPortionsByDrugName(ServerRequestInterface $request): array
    {
        $queryParams            = $request->getQueryParams();
        $drugPortionsByDrugName = [];

        foreach ($queryParams as $key => $value) {
            if (str_contains($key, 'drug-')) {
                $drugKey                           = str_replace('drug-', '', $key);
                $drugName                          = str_replace('_', ' ', $drugKey);
                $drugPortionsByDrugName[$drugName] = (int)$queryParams['portion-' . $drugKey];
            }
        }

        return $drugPortionsByDrugName;
    }
}
