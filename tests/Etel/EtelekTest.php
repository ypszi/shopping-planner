<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EtelekTest extends TestCase
{
    private Etel $testFood;

    protected function setUp(): void
    {
        $this->testFood = new Etel(
            name:           'test food',
            defaultPortion: 1,
            adag:           null,
            receptUrl:      'https://online-recept-konyv.hu/test-food',
            thumbnailUrl:   null,
            comments:       null,
            ingredients:    [
                                new Hozzavalo(
                                    name:         'Tojás',
                                    mennyiseg:    1,
                                    mertekegyseg: Mertekegyseg::DB,
                                    kategoria:    'Tejtermék'
                                ),
                            ]
        );
    }

    #[Test]
    public function testAdd(): void
    {
        $sut = new Etelek();
        $sut->add($this->testFood);

        $this->assertEquals(new Etelek([$this->testFood]), $sut);
    }

    #[Test]
    public function testToArray(): void
    {
        $this->assertEquals([$this->testFood], (new Etelek([$this->testFood]))->toArray());
    }
}
