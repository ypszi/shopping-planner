<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

class Etel
{
    private ?string $name;

    private int $adag;

    private int $defaultPortion;

    private ?string $receptUrl;

    private ?string $thumbnailUrl;

    /** @var Hozzavalo[] */
    private array $ingredients;

    /** @var string[]|null */
    private ?array $comments;

    public function __construct(
        string $name,
        int $defaultPortion,
        ?int $adag = null,
        ?string $receptUrl = null,
        ?string $thumbnailUrl = null,
        ?array $comments = [],
        ?array $ingredients = null
    ) {
        $this->name           = $name;
        $this->adag           = $adag ?? $defaultPortion;
        $this->defaultPortion = $defaultPortion;
        $this->receptUrl      = $receptUrl;
        $this->thumbnailUrl   = $thumbnailUrl;
        $this->comments       = $comments;

        $this->addHozzavalok($ingredients);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function defaultPortion(): int
    {
        return $this->defaultPortion;
    }

    public function receptUrl(): ?string
    {
        $rawReceptUrl = $this->rawReceptUrl();

        if (empty($rawReceptUrl)) {
            return $rawReceptUrl;
        }

        return $this->decorateNoSaltyReceptUrl($rawReceptUrl);
    }

    public function thumbnailUrl(): ?string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @return Hozzavalo[]
     */
    protected function listHozzavalok(): array
    {
        return $this->ingredients;
    }

    protected function rawReceptUrl(): ?string
    {
        return $this->receptUrl;
    }

    public function withAdag(int $adag): self
    {
        $clone       = clone $this;
        $clone->adag = $adag;

        $clone->addHozzavalok($clone->hozzavalok());

        return $clone;
    }

    /**
     * @return Hozzavalo[]
     */
    public function hozzavalok(): array
    {
        return $this->ingredients;
    }

    public function comments(): array
    {
        return $this->comments;
    }

    protected function decorateNoSaltyReceptUrl(string $receptUrl): string
    {
        $urlParts = parse_url($receptUrl);

        if (str_contains($urlParts['host'], 'nosalty.hu')) {
            $baseUri     = $this->removeQueryString($receptUrl);
            $queryString = $this->replaceAdagQueryString($receptUrl);

            return sprintf('%s?%s', $baseUri, $queryString);
        }

        return $receptUrl;
    }

    public function __toString(): string
    {
        return sprintf('%s (%d adag)', $this->name(), $this->adag);
    }

    private function addHozzavalok(array $hozzavalok): void
    {
        $this->ingredients = [];

        foreach ($hozzavalok as $hozzavalo) {
            $adagMennyiseg       = $hozzavalo->getMennyiseg() / static::defaultPortion() * $this->adag;
            $this->ingredients[] = $hozzavalo->withMennyiseg($adagMennyiseg);
        }
    }

    private function replaceAdagQueryString(string $receptUrl): string
    {
        $urlParts            = parse_url($receptUrl);
        $originalQueryString = $urlParts['query'] ?? '';
        $queryString         = $originalQueryString;

        if (preg_match('/adag=\d+/', $originalQueryString)) {
            $queryString = preg_replace('/adag=\d+/', '', $originalQueryString);
        }

        if (!empty($queryString)) {
            $queryString .= '&';
        }

        $queryString .= sprintf('adag=%d', $this->adag);

        return $queryString;
    }

    public function removeQueryString(string $receptUrl): string
    {
        $urlParts            = parse_url($receptUrl);
        $originalQueryString = $urlParts['query'] ?? '';

        return rtrim(str_replace($originalQueryString, '', $receptUrl), '?');
    }
}
