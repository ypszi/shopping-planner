<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\ShoppingList;

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

    public function filterEmptyColumns(): self
    {
        $header = $this->filterHeader();
        $rows   = $this->filterRows();

        return new ShoppingListByFood($header, $rows);
    }

    /**
     * @return string[]
     */
    private function filterHeader(): array
    {
        $emptyColumnIndexesForShoppingListByFood = $this->collectEmptyColumnIndexes();
        $newHeader                               = [];
        $onlyEmptyColumnIndexes                  = [];

        foreach ($emptyColumnIndexesForShoppingListByFood as $emptyColumnIndexes) {
            $tmpEmptyColumnIndexes = $onlyEmptyColumnIndexes;

            foreach ($emptyColumnIndexes as $colIdx => $isEmpty) {
                $onlyEmptyColumnIndexes[$colIdx] = $isEmpty && ($tmpEmptyColumnIndexes[$colIdx] ?? true);
            }
        }

        foreach ($this->header as $colIdx => $colValue) {
            if (!($onlyEmptyColumnIndexes[$colIdx] ?? null)) {
                $newHeader[] = $colValue;
            }
        }

        return $newHeader;
    }

    /**
     * @return string[][][]
     */
    private function filterRows(): array
    {
        $emptyColumnIndexesForShoppingListByFood = $this->collectEmptyColumnIndexes();
        $newRows                                 = [];
        $onlyEmptyColumnIndexes                  = [];

        foreach ($emptyColumnIndexesForShoppingListByFood as $emptyColumnIndexes) {
            $tmpEmptyColumnIndexes = $onlyEmptyColumnIndexes;

            foreach ($emptyColumnIndexes as $colIdx => $isEmpty) {
                $onlyEmptyColumnIndexes[$colIdx] = $isEmpty && ($tmpEmptyColumnIndexes[$colIdx] ?? true);
            }
        }

        foreach ($this->rows as $foodName => $rows) {
            foreach ($rows as $rowIdx => $row) {
                foreach ($row as $colIdx => $cell) {
                    if (!($onlyEmptyColumnIndexes[$colIdx] ?? null)) {
                        $newRows[$foodName][$rowIdx][] = $cell;
                    }
                }
            }
        }

        return $newRows;
    }

    /**
     * @return array<string, array<int, bool>>
     */
    private function collectEmptyColumnIndexes(): array
    {
        $emptyColumnIndexesForShoppingListByFood = [];

        foreach ($this->rows as $foodName => $rows) {
            $firstRow = $rows[0] ?? [];
            foreach ($firstRow as $colIdx => $cell) {
                $emptyColumnIndexesForShoppingListByFood[$foodName][$colIdx] = empty($cell);
            }
        }

        return $emptyColumnIndexesForShoppingListByFood;
    }
}
