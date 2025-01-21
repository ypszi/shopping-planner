<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Factory\AvailableDrugFactory;
use PeterPecosz\ShoppingPlanner\Drug\Factory\DrugFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class AvailableDrugFactoryTest extends TestCase
{
    private AvailableDrugFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new AvailableDrugFactory(
            new DrugFactory(
                __DIR__ . '/../../../app/drugs.yaml',
                __DIR__ . '/../../../app/drugCategories.yaml'
            ),
            __DIR__ . '/../../../app/drugs.yaml',
        );
    }

    #[Test]
    public function testListAvailableDrugs(): void
    {
        $this->assertCount(9, $this->sut->listAvailableDrugs());
    }
}
