<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Shopping\Action;

use PeterPecosz\Kajatervezo\Etel\Factory\EtelekFactory;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class ShoppingPlannerAction
{
    public function __construct(
        private SupermarketFactory $supermarketFactory,
        private EtelekFactory $etelekFactory,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $availableSupermarkets = array_combine(
            range(1, count($this->supermarketFactory->listAvailableSupermarkets())),
            array_values($this->supermarketFactory->listAvailableSupermarkets())
        );

        $availableFoods = $this->etelekFactory->listAvailableFoods();

        $queryParams        = $request->getQueryParams();
        $defaultSupermarket = $queryParams['supermarket'] ?? Supermarket::DEFAULT;

        $foods         = array_filter($queryParams, fn(string $key) => str_contains($key, 'food-'), ARRAY_FILTER_USE_KEY);
        $portions      = array_filter($queryParams, fn(string $key) => str_contains($key, 'portion-'), ARRAY_FILTER_USE_KEY);
        $selectedFoods = [];

        foreach ($foods as $key => $value) {
            $portionKey            = str_replace('food-', 'portion-', $key);
            $selectedFoods[$value] = $portions[$portionKey];
        }

        $response->getBody()->write(
            $this->twig->render('shopping-planner.html.twig', [
                'defaultSupermarket'    => $defaultSupermarket,
                'availableSupermarkets' => $availableSupermarkets,
                'availableFoods'        => $availableFoods,
                'selectedFoods'         => $selectedFoods,
            ])
        );

        return $response;
    }
}
