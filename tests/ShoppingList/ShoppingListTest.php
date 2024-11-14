<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\ShoppingList;

use PeterPecosz\ShoppingPlanner\ShoppingList\ShoppingList;
use PHPUnit\Framework\TestCase;

class ShoppingListTest extends TestCase
{
    #[Test]
    public function testFilterEmptyColumnsWhenEveryCellIsFilled(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', 'row12', 'row13'],
                ['row21', 'row22', 'row23'],
                ['row31', 'row32', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col2', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11', 'row12', 'row13'],
                ['row21', 'row22', 'row23'],
                ['row31', 'row32', 'row33'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenAColumnIsEmpty(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', '', 'row13'],
                ['row21', '', 'row23'],
                ['row31', '', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11', 'row13'],
                ['row21', 'row23'],
                ['row31', 'row33'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenOneCellIsEmptyInFirstColumnOfFirstRow(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['', '', 'row13'],
                ['row21', '', 'row23'],
                ['row31', '', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row13'],
                ['row23'],
                ['row33'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenOneCellIsEmptyInLastColumnOfFirstRow(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', '', ''],
                ['row21', '', 'row23'],
                ['row31', '', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11'],
                ['row21'],
                ['row31'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenOneCellIsEmptyInFirstColumnOfMiddleRow(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', '', 'row13'],
                ['', '', 'row23'],
                ['row31', '', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11', 'row13'],
                ['', 'row23'],
                ['row31', 'row33'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenOneCellIsEmptyInLastColumnOfMiddleRow(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', '', 'row13'],
                ['row21', '', ''],
                ['row31', '', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11', 'row13'],
                ['row21', ''],
                ['row31', 'row33'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenOneCellIsEmptyInFirstColumnOfLastRow(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', '', 'row13'],
                ['row21', '', 'row23'],
                ['', '', 'row33'],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11', 'row13'],
                ['row21', 'row23'],
                ['', 'row33'],
            ],
            $filteredShoppingList->getRows()
        );
    }

    #[Test]
    public function testFilterEmptyColumnsWhenOneCellIsEmptyInLastColumnOfLastRow(): void
    {
        $sut = new ShoppingList(
            ['col1', 'col2', 'col3'],
            [
                ['row11', '', 'row13'],
                ['row21', '', 'row23'],
                ['row31', '', ''],
            ]
        );

        $filteredShoppingList = $sut->filterEmptyColumns();
        $this->assertEquals(
            ['col1', 'col3'],
            $filteredShoppingList->getHeader()
        );
        $this->assertEquals(
            [
                ['row11', 'row13'],
                ['row21', 'row23'],
                ['row31', ''],
            ],
            $filteredShoppingList->getRows()
        );
    }
}
