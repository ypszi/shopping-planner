<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\ShoppingList;

use PeterPecosz\Kajatervezo\ShoppingList\ShoppingListByFood;
use PHPUnit\Framework\TestCase;

class ShoppingListByFoodTest extends TestCase
{
    public function testFilterEmptyColumnsWhenEveryCellIsFilled(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col2', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenAColumnIsEmpty(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row13'],
                    ['row21', 'row23'],
                    ['row31', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenOneCellIsEmptyInFirstColumnOfFirstRow(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row13'],
                    ['row23'],
                    ['row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenOneCellIsEmptyInLastColumnOfFirstRow(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', ''],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11'],
                    ['row21'],
                    ['row31'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenOneCellIsEmptyInFirstColumnOfMiddleRow(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row13'],
                    ['', 'row23'],
                    ['row31', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenOneCellIsEmptyInLastColumnOfMiddleRow(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', ''],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row13'],
                    ['row21', ''],
                    ['row31', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenOneCellIsEmptyInFirstColumnOfLastRow(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row13'],
                    ['row21', 'row23'],
                    ['', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenOneCellIsEmptyInLastColumnOfLastRow(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', ''],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row13'],
                    ['row21', 'row23'],
                    ['row31', ''],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenAColumnIsEmptyOfFirstFood(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
                'food2' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food3' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col2', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
                'food2' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food3' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenAColumnIsEmptyOfFoodInTheMiddle(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food2' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
                'food3' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col2', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food2' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
                'food3' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenAColumnIsEmptyOfLastFood(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food2' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food3' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col2', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food2' => [
                    ['row11', 'row12', 'row13'],
                    ['row21', 'row22', 'row23'],
                    ['row31', 'row32', 'row33'],
                ],
                'food3' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }

    public function testFilterEmptyColumnsWhenAColumnIsEmptyOfAllFood(): void
    {
        $sut = new ShoppingListByFood(
            ['col1', 'col2', 'col3'],
            [
                'food1' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
                'food2' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
                'food3' => [
                    ['row11', '', 'row13'],
                    ['row21', '', 'row23'],
                    ['row31', '', 'row33'],
                ],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                'food1' => [
                    ['row11', 'row13'],
                    ['row21', 'row23'],
                    ['row31', 'row33'],
                ],
                'food2' => [
                    ['row11', 'row13'],
                    ['row21', 'row23'],
                    ['row31', 'row33'],
                ],
                'food3' => [
                    ['row11', 'row13'],
                    ['row21', 'row23'],
                    ['row31', 'row33'],
                ],
            ],
            $filteredShoppingList->getRows()
        );
    }
}
