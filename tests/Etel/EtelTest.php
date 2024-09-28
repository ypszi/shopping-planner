<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class EtelTest extends TestCase
{
    private Etel $testFood;

    protected function setUp(): void
    {
        $this->testFood = new Etel(
            name:           'test food',
            defaultPortion: 1,
            adag:           null,
            receptUrl:      'https://online-recept-konyv.hu/test-food',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new Hozzavalo(
                                    name:         'Tojás',
                                    mennyiseg:    1,
                                    mertekegyseg: Mertekegyseg::DB,
                                    kategoria:    HozzavaloKategoria::TEJTERMEK,
                                ),
                            ]
        );
    }

    #[Test]
    public function testName(): void
    {
        $this->assertEquals('test food', $this->testFood->name());
    }

    #[Test]
    public function testReceptUrl(): void
    {
        $this->assertEquals('https://online-recept-konyv.hu/test-food', $this->testFood->receptUrl());
    }

    #[Test]
    public function testReceptUrlHasNosalty(): void
    {
        $sut = new Etel(
            name:           'test food',
            defaultPortion: 1,
            adag:           null,
            receptUrl:      'https://www.nosalty.hu/recept/test-food',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new Hozzavalo(
                                    name:         'Tojás',
                                    mennyiseg:    1,
                                    mertekegyseg: Mertekegyseg::DB,
                                    kategoria:    HozzavaloKategoria::TEJTERMEK,
                                ),
                            ]
        );

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?adag=1', $sut->receptUrl());
    }

    #[Test]
    public function testReceptUrlHasNosaltyHavingQueryParam(): void
    {
        $sut = new Etel(
            name:           'test food',
            defaultPortion: 1,
            adag:           null,
            receptUrl:      'https://www.nosalty.hu/recept/test-food?query=test',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new Hozzavalo(
                                    name:         'Tojás',
                                    mennyiseg:    1,
                                    mertekegyseg: Mertekegyseg::DB,
                                    kategoria:    HozzavaloKategoria::TEJTERMEK,
                                ),
                            ]
        );

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?query=test&adag=1', $sut->receptUrl());
    }

    #[Test]
    public function testReceptUrlHasNosaltyHavingAdagQueryParam(): void
    {
        $sut = new Etel(
            name:           'test food',
            defaultPortion: 1,
            adag:           null,
            receptUrl:      'https://www.nosalty.hu/recept/test-food?adag=1',
            thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
            comments:       null,
            ingredients:    [
                                new Hozzavalo(
                                    name:         'Tojás',
                                    mennyiseg:    1,
                                    mertekegyseg: Mertekegyseg::DB,
                                    kategoria:    HozzavaloKategoria::TEJTERMEK,
                                ),
                            ]
        );

        $this->assertEquals('https://www.nosalty.hu/recept/test-food?adag=1', $sut->receptUrl());
    }

    #[Test]
    public function testDefaultPortion(): void
    {
        $this->assertEquals(1, $this->testFood->defaultPortion());
    }

    #[Test]
    public function testWithAdag(): void
    {
        $this->assertEquals(
            new Etel(
                name:           'test food',
                defaultPortion: 1,
                adag:           4,
                receptUrl:      'https://online-recept-konyv.hu/test-food',
                thumbnailUrl:   'https://www.nosalty.hu/thumnails/img_5512.jpg',
                comments:       null,
                ingredients:    [
                                    new Hozzavalo(
                                        name:         'Tojás',
                                        mennyiseg:    1,
                                        mertekegyseg: Mertekegyseg::DB,
                                        kategoria:    HozzavaloKategoria::TEJTERMEK,
                                    ),
                                ]
            ),
            $this->testFood->withAdag(4)
        );
    }

    #[Test]
    public function testHozzavalok(): void
    {
        $this->assertEquals(
            [
                new Hozzavalo(
                    name:         'Tojás',
                    mennyiseg:    1,
                    mertekegyseg: Mertekegyseg::DB,
                    kategoria:    HozzavaloKategoria::TEJTERMEK,
                ),
            ],
            $this->testFood->hozzavalok()
        );
    }

    #[Test]
    public function testThumbnailUrl(): void
    {
        $this->assertEquals('https://www.nosalty.hu/thumnails/img_5512.jpg', $this->testFood->thumbnailUrl());
    }

    #[Test]
    public function testStringify(): void
    {
        $this->assertEquals('test food (1 adag)', (string)$this->testFood);
    }
}
