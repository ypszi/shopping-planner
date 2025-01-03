<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food;

use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;

class Food
{
    /**
     * @param string[]            $tags
     * @param string[]            $comments
     * @param string[]            $cookingSteps
     * @param IngredientForFood[] $ingredients
     */
    public function __construct(
        private readonly string $name,
        private readonly int $defaultPortion,
        private ?int $portion = null,
        private readonly ?string $recipeUrl = null,
        private readonly ?string $thumbnailUrl = null,
        private readonly array $tags = [],
        private readonly array $comments = [],
        private readonly array $cookingSteps = [],
        private array $ingredients = []
    ) {
        $this->portion = $portion ?? $defaultPortion;

        $this->addIngredients($ingredients);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function defaultPortion(): int
    {
        return $this->defaultPortion;
    }

    public function recipeDomain(): string
    {
        $rawRecipeUrl = $this->rawRecipeUrl();

        if (empty($rawRecipeUrl)) {
            return $rawRecipeUrl;
        }

        return $this->extractHost($rawRecipeUrl);
    }

    public function recipeUrl(): ?string
    {
        $rawRecipeUrl = $this->rawRecipeUrl();

        if (empty($rawRecipeUrl)) {
            return $rawRecipeUrl;
        }

        return $this->decorateNoSaltyRecipeUrl($rawRecipeUrl);
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    protected function rawRecipeUrl(): ?string
    {
        return $this->recipeUrl;
    }

    public function withAdag(int $adag): self
    {
        $clone          = clone $this;
        $clone->portion = $adag;

        $clone->addIngredients($clone->ingredients());

        return $clone;
    }

    /**
     * @return IngredientForFood[]
     */
    public function ingredients(): array
    {
        return $this->ingredients;
    }

    /**
     * @return string[]
     */
    public function tags(): array
    {
        return $this->tags;
    }

    /**
     * @return string[]
     */
    public function comments(): array
    {
        return $this->comments;
    }

    /**
     * @return string[]
     */
    public function cookingSteps(): array
    {
        return $this->cookingSteps;
    }

    public function __toString(): string
    {
        return sprintf('%s (%d adag)', $this->name(), $this->portion);
    }

    private function decorateNoSaltyRecipeUrl(string $recipeUrl): string
    {
        $host = $this->extractHost($recipeUrl);

        if (str_contains($host, 'nosalty.hu')) {
            $baseUri     = $this->removeQueryString($recipeUrl);
            $queryString = $this->replaceAdagQueryString($recipeUrl);

            return sprintf('%s?%s', $baseUri, $queryString);
        }

        return $recipeUrl;
    }

    private function extractHost(string $recipeUrl): string
    {
        $urlParts = parse_url($recipeUrl);

        return $urlParts['host'] ?? '';
    }

    /**
     * @param IngredientForFood[] $ingredients
     */
    private function addIngredients(array $ingredients): void
    {
        $this->ingredients = [];

        foreach ($ingredients as $ingredient) {
            $portion             = $ingredient->portion() / static::defaultPortion() * $this->portion;
            $this->ingredients[] = $ingredient->withPortion($portion);
        }
    }

    private function replaceAdagQueryString(string $recipeUrl): string
    {
        $urlParts            = parse_url($recipeUrl);
        $originalQueryString = $urlParts['query'] ?? '';
        $queryString         = $originalQueryString;

        if (preg_match('/adag=\d+/', $originalQueryString)) {
            $queryString = preg_replace('/adag=\d+/', '', $originalQueryString);
        }

        if (!empty($queryString)) {
            $queryString .= '&';
        }

        $queryString .= sprintf('adag=%d', $this->portion);

        return $queryString;
    }

    public function removeQueryString(string $recipeUrl): string
    {
        $urlParts            = parse_url($recipeUrl);
        $originalQueryString = $urlParts['query'] ?? '';

        return rtrim(str_replace($originalQueryString, '', $recipeUrl), '?');
    }
}
