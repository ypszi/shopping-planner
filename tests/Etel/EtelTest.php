<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Hozzavalo\Tejtermek\Tojas;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EtelTest extends TestCase
{
    private Etel $testFood;

    protected function setUp(): void
    {
        $this->testFood = new class() extends Etel {
            public static function name(): string
            {
                return 'test food';
            }

            protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                ];
            }

            public static function defaultAdag(): int
            {
                return 1;
            }

            public function rawReceptUrl(): string
            {
                return 'https://online-recept-konyv.hu/test-food';
            }
        };
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('test food', $this->testFood::name());
    }

    #[Test]
    public function testReceptUrl(): void
    {
        $this->assertEquals('https://online-recept-konyv.hu/test-food', $this->testFood->receptUrl());
    }

    #[Test]
    public function testReceptUrlHasNosalty(): void
    {
        $sut = new class() extends Etel {
            public static function name(): string
            {
                return 'test food';
            }

            protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                ];
            }

            public static function defaultAdag(): int
            {
                return 1;
            }

            public function rawReceptUrl(): string
            {
                return 'https://www.nosalty.hu/recept/test-food';
            }
        };

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?adag=1', $sut->receptUrl());
    }

    #[Test]
    public function testReceptUrlHasNosaltyHavingQueryParam(): void
    {
        $sut = new class() extends Etel {
            public static function name(): string
            {
                return 'test food';
            }

            protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                ];
            }

            public static function defaultAdag(): int
            {
                return 1;
            }

            public function rawReceptUrl(): string
            {
                return 'https://www.nosalty.hu/recept/test-food?query=test';
            }
        };

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?query=test&adag=1', $sut->receptUrl());
    }

    #[Test]
    public function testReceptUrlHasNosaltyHavingAdagQueryParam(): void
    {
        $sut = new class() extends Etel {
            public static function name(): string
            {
                return 'test food';
            }

            protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                ];
            }

            public static function defaultAdag(): int
            {
                return 1;
            }

            public function rawReceptUrl(): string
            {
                return 'https://www.nosalty.hu/recept/test-food?adag=1';
            }
        };

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?adag=1', $sut->receptUrl());
    }

    #[Test]
    public function testDefaultAdag(): void
    {
        $this->assertEquals(1, $this->testFood::defaultAdag());
    }

    #[Test]
    public function testWithAdag(): void
    {
        $this->assertEquals(new $this->testFood(4), $this->testFood->withAdag(4));
    }

    #[Test]
    public function testHozzavalok(): void
    {
        $this->assertEquals(
            [
                new Tojas(1, Mertekegyseg::DB),
            ],
            $this->testFood->hozzavalok()
        );
    }

    #[Test]
    public function testStringify(): void
    {
        $this->assertEquals('test food (1 adag)', (string)$this->testFood);
    }
}
