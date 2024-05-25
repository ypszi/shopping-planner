<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel;

use Override;
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
            #[Override] public static function name(): string
            {
                return 'test food';
            }

            #[Override] protected function listHozzavalok(): array
            {
                return [
                    new Tojas(1, Mertekegyseg::DB),
                ];
            }

            #[Override] public static function defaultAdag(): int
            {
                return 1;
            }

            #[Override] public function receptUrl(): string
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
