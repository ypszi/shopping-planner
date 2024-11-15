<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Ingredient\Action;

use PeterPecosz\ShoppingPlanner\Ingredient\Factory\AvailableIngredientFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

readonly class GetIngredientStorageAction
{
    public function __construct(
        private AvailableIngredientFactory $availableIngredientFactory,
        private Environment $twig
    ) {
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $availableIngredients = $this->availableIngredientFactory->listAvailableIngredients();

        $response->getBody()->write(
            $this->twig->render('ingredients.html.twig', [
                'availableIngredients'     => $availableIngredients,
            ])
        );

        return $response;
    }
}
