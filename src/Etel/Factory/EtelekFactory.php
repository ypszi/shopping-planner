<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel\Factory;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Etel\Exception\UnknownIngredientException;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use Symfony\Component\Yaml\Yaml;

class EtelekFactory
{
    private readonly array $foods;

    private readonly array $ingredients;

    private readonly array $ingredientCategories;

    public function __construct(string $foodsPath, string $ingredientsPath, string $ingredientCategoriesPath)
    {
        $this->foods                = Yaml::parseFile($foodsPath);
        $this->ingredients          = Yaml::parseFile($ingredientsPath);
        $this->ingredientCategories = Yaml::parseFile($ingredientCategoriesPath);
    }

    /**
     * @param array<string, int> $foodPortionsByFoodName
     *
     * @return Etelek
     */
    public function create(array $foodPortionsByFoodName): Etelek
    {
        $etelek = new Etelek();

        foreach ($foodPortionsByFoodName as $foodName => $adag) {
            $food = $this->foods[$foodName] ?? null;

            if (!isset($food)) {
                continue;
            }

            $hozzavalok = [];

            foreach ($food['ingredients'] as $ingredient) {
                if (isset($ingredient['ref'])) {
                    $refFoodName    = $ingredient['ref'];
                    $additionalFood = $this->createReferenceFood($refFoodName, $foodPortionsByFoodName);
                    $hozzavalok     = array_merge($hozzavalok, $additionalFood->hozzavalok());

                    continue;
                }

                $hozzavalok[] = $this->createIngredient($ingredient);
            }

            $etel = $this->createFood($foodName, $food, $hozzavalok, $foodPortionsByFoodName);

            $etelek->add($etel);
        }

        return $etelek;
    }

    /**
     * @return Etel[]
     */
    public function createAvailableFoods(): array
    {
        $availableFoods = [];

        foreach ($this->foods as $foodName => $food) {
            $hozzavalok = [];

            foreach ($food['ingredients'] as $ingredient) {
                if (isset($ingredient['ref'])) {
                    $refFoodName    = $ingredient['ref'];
                    $additionalFood = $this->createReferenceFood($refFoodName);
                    $hozzavalok     = array_merge($hozzavalok, $additionalFood->hozzavalok());

                    continue;
                }

                $hozzavalok[] = $this->createIngredient($ingredient);
            }

            $availableFoods[] = $this->createFood($foodName, $food, $hozzavalok);
        }

        return $availableFoods;
    }

    /**
     * @param array<string, mixed> $ingredient
     */
    private function createIngredient(array $ingredient): Hozzavalo
    {
        $ingredientName = $ingredient['name'];

        if (is_string($ingredientRefName = $this->ingredients[$ingredientName])) {
            $ingredientRef = $this->ingredients[$ingredientRefName] ?? null;

            if (!$ingredientRef) {
                throw new UnknownIngredientException(
                    sprintf('Ingredient reference not found: "%s"', $ingredientRefName)
                );
            }

            $ingredientName = $ingredientRefName;
            $ingredient     += $ingredientRef;
        }

        $defaultIngredient      = $this->ingredients[$ingredientName] ?? [];
        $category               = $ingredient['kategoria'] ?? $defaultIngredient['kategoria'] ?? null;
        $mertekegysegPreference = $ingredient['mertekegysegPreference']
                                  ?? $defaultIngredient['mertekegysegPreference']
                                     ?? $this->ingredientCategories[$category]['mertekegysegPreference']
                                        ?? null;

        if (!$category) {
            throw new UnknownIngredientException(
                sprintf('Ingredient not found: "%s"', $ingredientName)
            );
        }

        if ($category !== $defaultIngredient['kategoria']) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category mismatch for "%s": "%s" - "%s"',
                    $ingredientName,
                    $ingredient['kategoria'],
                    $defaultIngredient['kategoria']
                )
            );
        }

        if ($defaultIngredient && !in_array($defaultIngredient['kategoria'], array_keys($this->ingredientCategories))) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient category not found for "%s": "%s"',
                    $ingredientName,
                    $defaultIngredient['kategoria']
                )
            );
        }

        if ($mertekegysegPreference && !$ingredientMertekegysegPreference = Mertekegyseg::tryFrom($mertekegysegPreference)) {
            throw new UnknownIngredientException(
                sprintf(
                    'Ingredient measurement not found for "%s": "%s"',
                    $ingredientName,
                    $mertekegysegPreference
                )
            );
        }

        return new Hozzavalo(
            $ingredientName,
            $ingredient['mennyiseg'],
            Mertekegyseg::from($ingredient['mertekegyseg']),
            HozzavaloKategoria::from($category),
            $ingredientMertekegysegPreference ?? null
        );
    }

    /**
     * @param array<string, int> $foodPortionsByFoodName
     */
    public function createReferenceFood(string $refFoodName, array $foodPortionsByFoodName = []): Etel
    {
        $additionalRawFood    = $this->foods[$refFoodName];
        $additionalHozzavalok = [];
        foreach ($this->foods[$refFoodName]['ingredients'] as $additionalIngredient) {
            $additionalHozzavalok[] = $this->createIngredient($additionalIngredient);
        }

        return $this->createFood($refFoodName, $additionalRawFood, $additionalHozzavalok, $foodPortionsByFoodName);
    }

    /**
     * @param array<string, mixed> $food
     * @param Hozzavalo[]          $hozzavalok
     * @param array<string, int>   $foodPortionsByFoodName
     */
    private function createFood(string $foodName, array $food, array $hozzavalok, array $foodPortionsByFoodName = []): Etel
    {
        return new Etel(
            $foodName,
            $food['defaultPortion'],
            $foodPortionsByFoodName[$foodName] ?? null,
            $food['receptUrl'] ?? null,
            $food['thumbnailUrl'] ?? null,
            $food['comments'] ?? [],
            $hozzavalok
        );
    }
}
