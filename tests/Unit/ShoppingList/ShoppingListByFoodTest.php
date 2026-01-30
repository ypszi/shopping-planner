<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Unit\ShoppingList;

use PeterPecosz\ShoppingPlanner\ShoppingList\ShoppingListByFood;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ShoppingListByFoodTest extends TestCase
{
    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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
