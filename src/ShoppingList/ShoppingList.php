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

    public function filterEmptyColumns(): self
    {
        $header = $this->filterHeader();
        $rows   = $this->filterRows();

        return new ShoppingList($header, $rows);
    }

    /**
     * @return string[]
     */
    private function filterHeader(): array
    {
        $emptyColumnIndexesForShoppingList = $this->collectEmptyColumnIndexes();
        $newHeader                         = [];

        foreach ($this->header as $colIdx => $colValue) {
            if (!$emptyColumnIndexesForShoppingList[$colIdx]) {
                $newHeader[] = $colValue;
            }
        }

        return $newHeader;
    }

    /**
     * @return string[][]
     */
    private function filterRows(): array
    {
        $emptyColumnIndexesForShoppingList = $this->collectEmptyColumnIndexes();
        $newRows                           = [];

        foreach ($this->rows as $rowIdx => $row) {
            foreach ($row as $colIdx => $cell) {
                if (!$emptyColumnIndexesForShoppingList[$colIdx]) {
                    $newRows[$rowIdx][] = $cell;
                }
            }
        }

        return $newRows;
    }

    /**
     * @return array<int, bool>
     */
    private function collectEmptyColumnIndexes(): array
    {
        $emptyColumnIndexesForShoppingList = [];

        $firstRow = $this->rows[0] ?? [];
        foreach ($firstRow as $colIdx => $cell) {
            $emptyColumnIndexesForShoppingList[$colIdx] = empty($cell);
        }

        return $emptyColumnIndexesForShoppingList;
    }
}
