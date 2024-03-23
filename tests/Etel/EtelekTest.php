<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSor;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloSorok;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EtelekTest extends TestCase
{
    private Etel $testFood;

    protected function setUp(): void
    {
        $this->testFood = new class() extends Etel {
            #[\Override] public static function name(): string
            {
                return 'test food';
            }

            #[\Override] protected static function listHozzavalok(): array
            {
                return [
                    new Hozzavalo(Hozzavalo::TOJAS, 1, Mertekegyseg::DB),
                ];
            }

            #[\Override] public static function defaultAdag(): int
            {
                return 1;
            }

            #[\Override] public function receptUrl(): string
            {
                return 'https://online-recept-konyv.hu/test-food';
            }
        };
    }

    #[Test]
    public function testAdd(): void
    {
        $sut = new Etelek();
        $sut->add($this->testFood);

        $this->assertEquals(new Etelek([$this->testFood]), $sut);
    }

    #[Test]
    public function testCreateHozzavaloSorok(): void
    {
        $sut = new Etelek([$this->testFood]);

        $hozzavaloSorok = $sut->createHozzavaloSorok();

        $this->assertEquals(new HozzavaloSorok([new HozzavaloSor([new Hozzavalo(Hozzavalo::TOJAS, 1, Mertekegyseg::DB)])]), $hozzavaloSorok);
    }

    #[Test]
    public function testToArray(): void
    {
        $this->assertEquals([$this->testFood], (new Etelek([$this->testFood]))->toArray());
    }
}
