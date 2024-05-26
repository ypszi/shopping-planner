<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\ShoppingList;

class ShoppingList
{
    /** @var string[] */
    private array $header;

    /** @var string[][] */
    private array $rows;

    /**
     * @param string[]   $header
     * @param string[][] $rows
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
     * @return string[][]
     */
    public function getRows(): array
    {
        return $this->rows;
    }
}
