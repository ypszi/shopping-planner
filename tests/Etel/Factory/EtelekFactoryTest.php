<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Tests\Etel\Factory;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelekFactory;
use PeterPecosz\Kajatervezo\Hozzavalo\Hozzavalo;
use PeterPecosz\Kajatervezo\Mertekegyseg\Mertekegyseg;
use PHPUnit\Framework\TestCase;

class EtelekFactoryTest extends TestCase
{
    private EtelekFactory $sut;

    protected function setUp(): void
    {
        $this->sut = new EtelekFactory(
            __DIR__ . '/../../../app/foods.yaml',
            __DIR__ . '/../../../app/ingredients.yaml',
            __DIR__ . '/../../../app/ingredientCategories.yaml'
        );
    }

    public function testCreate(): void
    {
        $food = $this->sut->create(['Alpesi Sajtos Tészta (Älplermagronen)' => 8]);

        $this->assertEquals(
            new Etelek(
                [
                    new Etel(
                        name:           'Alpesi Sajtos Tészta (Älplermagronen)',
                        defaultPortion: 4,
                        adag:           8,
                        receptUrl:      'https://www.mindmegette.hu/alpesi-sajtos-teszta-alplermagronen.recept/',
                        thumbnailUrl:   'https://www.mindmegette.hu/images/156/O/crop_201607031143_thinkstockphotos-139579352.jpg',
                        comments:       [
                                            'Vaj kell a tepsi kikenéséhez',
                                            'opcionális: 1 ek Petrezselyem',
                                        ],
                        ingredients:    [
                                            new Hozzavalo(
                                                name:                   'Burgonya',
                                                mennyiseg:              40,
                                                mertekegyseg:           Mertekegyseg::DKG,
                                                kategoria:              'Zöldség / Gyümölcs',
                                                mertekegysegPreference: Mertekegyseg::DKG
                                            ),
                                            new Hozzavalo(
                                                name:                   'Só',
                                                mennyiseg:              1,
                                                mertekegyseg:           Mertekegyseg::TK,
                                                kategoria:              'Fűszer',
                                                mertekegysegPreference: Mertekegyseg::G
                                            ),
                                            new Hozzavalo(
                                                name:                   'Makaróni tészta',
                                                mennyiseg:              25,
                                                mertekegyseg:           Mertekegyseg::DKG,
                                                kategoria:              'Tartós élelmiszer',
                                                mertekegysegPreference: Mertekegyseg::G
                                            ),
                                            new Hozzavalo(
                                                name:                   'Gouda sajt',
                                                mennyiseg:              20,
                                                mertekegyseg:           Mertekegyseg::DKG,
                                                kategoria:              'Sajt',
                                                mertekegysegPreference: Mertekegyseg::G
                                            ),
                                            new Hozzavalo(
                                                name:                   'Tej',
                                                mennyiseg:              1.5,
                                                mertekegyseg:           Mertekegyseg::DL,
                                                kategoria:              'Tartós tejtermék',
                                                mertekegysegPreference: Mertekegyseg::L
                                            ),
                                            new Hozzavalo(
                                                name:                   'Főzőtejszín',
                                                mennyiseg:              1,
                                                mertekegyseg:           Mertekegyseg::DL,
                                                kategoria:              'Tartós tejtermék',
                                                mertekegysegPreference: Mertekegyseg::ML
                                            ),
                                            new Hozzavalo(
                                                name:                   'Bors',
                                                mennyiseg:              1,
                                                mertekegyseg:           Mertekegyseg::CSIPET,
                                                kategoria:              'Fűszer',
                                                mertekegysegPreference: Mertekegyseg::G
                                            ),
                                            new Hozzavalo(
                                                name:                   'Vöröshagyma',
                                                mennyiseg:              2,
                                                mertekegyseg:           Mertekegyseg::DB,
                                                kategoria:              'Zöldség / Gyümölcs',
                                                mertekegysegPreference: Mertekegyseg::DB
                                            ),
                                            new Hozzavalo(
                                                name:                   'Olíva olaj',
                                                mennyiseg:              2,
                                                mertekegyseg:           Mertekegyseg::EK,
                                                kategoria:              'Olaj',
                                                mertekegysegPreference: Mertekegyseg::L
                                            ),
                                            new Hozzavalo(
                                                name:                   'Petrezselyem',
                                                mennyiseg:              1,
                                                mertekegyseg:           Mertekegyseg::EK,
                                                kategoria:              'Fűszer',
                                                mertekegysegPreference: Mertekegyseg::G
                                            ),
                                        ]
                    ),
                ]
            ),
            $food
        );
    }

    public function testCreateAvailableFoods(): void
    {
        $this->assertCount(77, $this->sut->listAvailableFoods());
    }
}
