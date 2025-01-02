<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;

readonly class DrugShoppingListFactory
{
    public function __construct(private DrugsFactory $drugsFactory)
    {
    }

    /**
     * @param array<string, int> $portionsByDrugName
     *
     * @return array{header: string[], rows: array<array<string|DrugForShopping>>}
     */
    public function create(array $portionsByDrugName): array
    {
        $portionsByDrugName = array_filter($portionsByDrugName);
        $drugs              = $this->drugsFactory->create($portionsByDrugName);
        $header             = [];
        $rows               = [];

        foreach ($drugs as $drug) {
            $header[] = $drug->category()->name();
        }
        $header = array_values(array_unique($header));
        sort($header);

        foreach ($drugs as $drug) {
            $colIndex  = array_search($drug->category()->name(), $header, true);
            $drugAdded = false;

            foreach ($rows as &$row) {
                if (empty($row[$colIndex])) {
                    $row[$colIndex] = $drug;

                    $drugAdded = true;
                    break;
                }
            }

            if (!$drugAdded) {
                $newRow            = array_fill(0, count($header), '');
                $newRow[$colIndex] = $drug;
                $rows[]            = $newRow;
            }
        }

        return [
            'header' => $header,
            'rows'   => $rows,
        ];
    }
}
