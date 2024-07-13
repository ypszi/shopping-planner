<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\ShoppingList;

class ShoppingListByFood
{
    /** @var string[] */
    private array $header;

    /** @var array<string, string[][]> */
    private array $rows;

    /**
     * @param string[]                  $header
     * @param array<string, string[][]> $rows
     */
    public function __construct(array $header, array $rows)
    {
        $this->header = $header;
        $this->rows   = $rows;
    }

    /**
     * @return string[]
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @return array<string, string[][]>
     */
    public function getRows(): array
    {
        return $this->rows;
    }
}
