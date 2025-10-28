<?php

declare(strict_types=1);

namespace Food;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TemplatingProcessorTest extends TestCase
{
    private TemplatingProcessor $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new TemplatingProcessor();
    }

    #[Test]
    public function testReplacesVariables(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion}} onions',
                'peal {{ avocado }} avocado',
                'pour {{wine (dry)}} wine',
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
                new IngredientForFood('wine (dry)', 'drink', 1, Measure::DL),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 4 db onions',
                'peal 1 db avocado',
                'pour 1 dl wine',
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testReplacesMultipleVariablesWithinOneStep(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'pour {{beer}} beer and {{water}} water',
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
                new IngredientForFood('beer', 'liquid', 1, Measure::DL),
                new IngredientForFood('water', 'liquid', 1, Measure::DL),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'pour 1 dl beer and 1 dl water',
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testReplacesVariablesRegardlessCasing(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion}} onions',
                'peal {{Avocado}} avocado',
                'add {{Beer}} beer',
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('Onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
                new IngredientForFood('Beer', 'drink', 1, Measure::DL),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 4 db onions',
                'peal 1 db avocado',
                'add 1 dl beer',
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testReplacesVariablesOfReferences(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'Fűszerezzük {{bors}} borssal',
            ],
            ingredients   : [
                new IngredientForFood('Fekete bors', 'test', 3, Measure::EK, reference: new Ingredient('Bors', 'test')),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'Fűszerezzük 3 ek borssal',
            ],
            $result
        );
    }

    #[Test]
    public function testReplacesVariablesRecusively(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion}} onions',
                [
                    'peal {{avocado}} avocado',
                ],
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 4 db onions',
                [
                    'peal 1 db avocado',
                ],
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testReplacesVariablesRecusivelyHavingListOfSubSteps(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion}} onions',
                [
                    'next step::' => [
                        'peal {{avocado}} avocado',
                    ],
                ],
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 4 db onions',
                [
                    'next step::' => [
                        'peal 1 db avocado',
                    ],
                ],
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testReplacesVariablesInKeys(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion}} onions',
                [
                    'grab {{avocado}} avocado::' => [
                        'peal {{avocado}} avocado',
                    ],
                ],
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 4 db onions',
                [
                    'grab 1 db avocado::' => [
                        'peal 1 db avocado',
                    ],
                ],
                'cook',
                'serve',
            ],
            $result
        );
    }
}
