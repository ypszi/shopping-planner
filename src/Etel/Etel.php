<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel;

use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;

abstract class Etel
{
    /** @var Hozzavalo[] */
    private array $hozzavalok;

    protected int $adag;

    public function __construct(?int $adag = null)
    {
        $this->adag = $adag ?? static::defaultAdag();

        $this->addHozzavalok();
    }

    abstract public static function name(): string;

    abstract public static function defaultAdag(): int;

    public function receptUrl(): string
    {
        $rawReceptUrl = $this->rawReceptUrl();

        if (empty($rawReceptUrl)) {
            return $rawReceptUrl;
        }

        return $this->decorateNoSaltyReceptUrl($rawReceptUrl);
    }

    /**
     * @return Hozzavalo[]
     */
    abstract protected function listHozzavalok(): array;

    abstract protected function rawReceptUrl(): string;

    public function withAdag(int $adag): self
    {
        $clone       = clone $this;
        $clone->adag = $adag;

        $clone->addHozzavalok();

        return $clone;
    }

    /**
     * @return Hozzavalo[]
     */
    public function hozzavalok(): array
    {
        return $this->hozzavalok;
    }

    public function comments(): array
    {
        return [];
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
        return sprintf('%s (%d adag)', static::name(), $this->adag);
    }

    private function addHozzavalok(): void
    {
        $this->hozzavalok = [];

        foreach ($this->listHozzavalok() as $hozzavalo) {
            $adagMennyiseg      = $hozzavalo->getMennyiseg() / static::defaultAdag() * $this->adag;
            $this->hozzavalok[] = $hozzavalo->withMennyiseg($adagMennyiseg);
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
