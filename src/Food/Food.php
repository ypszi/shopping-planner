<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Food;

use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;

class Food
{
    private ?string $name;

    private int $portion;

    private int $defaultPortion;

    private ?string $recipeUrl;

    private ?string $thumbnailUrl;

    /** @var Ingredient[] */
    private array $ingredients;

    /** @var string[]|null */
    private ?array $comments;

    /**
     * @param string[]|null     $comments
     * @param Ingredient[]|null $ingredients
     */
    public function __construct(
        string $name,
        int $defaultPortion,
        ?int $portion = null,
        ?string $recipeUrl = null,
        ?string $thumbnailUrl = null,
        ?array $comments = [],
        ?array $ingredients = null
    ) {
        $this->name           = $name;
        $this->portion        = $portion ?? $defaultPortion;
        $this->defaultPortion = $defaultPortion;
        $this->recipeUrl      = $recipeUrl;
        $this->thumbnailUrl   = $thumbnailUrl;
        $this->comments       = $comments;

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
     * @return Ingredient[]
     */
    public function ingredients(): array
    {
        return $this->ingredients;
    }

    public function comments(): array
    {
        return $this->comments;
    }

    protected function decorateNoSaltyRecipeUrl(string $recipeUrl): string
    {
        $urlParts = parse_url($recipeUrl);

        if (str_contains($urlParts['host'], 'nosalty.hu')) {
            $baseUri     = $this->removeQueryString($recipeUrl);
            $queryString = $this->replaceAdagQueryString($recipeUrl);

            return sprintf('%s?%s', $baseUri, $queryString);
        }

        return $recipeUrl;
    }

    public function __toString(): string
    {
        return sprintf('%s (%d adag)', $this->name(), $this->portion);
    }

    /**
     * @param Ingredient[] $ingredients
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
