<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Shopping\Action;

use PeterPecosz\ShoppingPlanner\Core\Url\UrlBuilder;
use PeterPecosz\ShoppingPlanner\Drug\Factory\AvailableDrugFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodFactory;
use PeterPecosz\ShoppingPlanner\Food\Factory\AvailableFoodTagFactory;
use PeterPecosz\ShoppingPlanner\Ingredient\Action\GetIngredientStorageAction;
use PeterPecosz\ShoppingPlanner\Shopping\Input\FoodFilterInput;
use PeterPecosz\ShoppingPlanner\Shopping\Input\Operator;
use PeterPecosz\ShoppingPlanner\Supermarket\Supermarket;
use PeterPecosz\ShoppingPlanner\Supermarket\SupermarketFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class ShoppingPlannerAction
{
    public function __construct(
        private SupermarketFactory $supermarketFactory,
        private AvailableFoodFactory $availableFoodFactory,
        private AvailableFoodTagFactory $availableFoodTagFactory,
        private AvailableDrugFactory $availableDrugFactory,
        private UrlBuilder $urlBuilder,
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
        $tagsCriteria       = $queryParams['tags'] ?? null;
        $tagsOperator       = $queryParams['operator'] ?? Operator::OR->value;
        $foodFilterInput    = new FoodFilterInput($tagsCriteria, Operator::tryFrom($tagsOperator));
        $availableFoods     = $this->availableFoodFactory->listAvailableFoods($foodFilterInput);
        $availableFoodTags  = $this->availableFoodTagFactory->listAvailableFoodTags();
        $availableDrugs     = $this->availableDrugFactory->listAvailableDrugs();
        $selectedFoods      = $this->getSelectedFoods($request);
        $selectedDrugs      = $this->getSelectedDrugs($request);

        $response->getBody()->write(
            $this->twig->render(
                'shopping-planner.html.twig',
                [
                    'request'               => $request,
                    'defaultSupermarket'    => $defaultSupermarket,
                    'availableSupermarkets' => $availableSupermarkets,
                    'availableFoods'        => $availableFoods,
                    'availableFoodTags'     => $availableFoodTags,
                    'selectedFoods'         => $selectedFoods,
                    'availableDrugs'        => $availableDrugs,
                    'selectedDrugs'         => $selectedDrugs,
                    'ingredientStorageUrl'  => $this->urlBuilder->buildFor($request, GetIngredientStorageAction::class),
                ]
            )
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

    /**
     * @return array<string, int>
     */
    private function getSelectedDrugs(ServerRequestInterface $request): array
    {
        $queryParams   = $request->getQueryParams();
        $drugs         = array_filter($queryParams, fn(string $key) => str_contains($key, 'drug-'), ARRAY_FILTER_USE_KEY);
        $portions      = array_filter($queryParams, fn(string $key) => str_contains($key, 'portion-'), ARRAY_FILTER_USE_KEY);
        $selectedDrugs = [];

        foreach ($drugs as $key => $value) {
            $portionKey            = str_replace('drug-', 'portion-', $key);
            $selectedDrugs[$value] = $portions[$portionKey];
        }

        return $selectedDrugs;
    }
}
