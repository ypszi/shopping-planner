<?php

declare(strict_types=1);

namespace Food\CookingSteps;

use PeterPecosz\ShoppingPlanner\Food\CookingSteps\CookingStepsProcessor;
use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CookingStepsProcessorTest extends TestCase
{
    private CookingStepsProcessor $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new CookingStepsProcessor();
    }

    #[Test]
    public function testReplacesVariables(): void
    {
        $originalFood = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : [
                'cut {{onion}} onions',
                'peal {{avocado}} avocado',
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

        $food = $this->sut->process($originalFood);

        $this->assertEquals(
            [
                'cut 4 db onions',
                'peal 1 db avocado',
                'pour 1 dl wine',
                'cook',
                'serve',
            ],
            $food->cookingSteps()
        );
    }

    #[Test]
    public function testReplacesMultipleVariablesWithinOneStep(): void
    {
        $originalFood = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : [
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

        $food = $this->sut->process($originalFood);

        $this->assertEquals(
            [
                'pour 1 dl beer and 1 dl water',
                'cook',
                'serve',
            ],
            $food->cookingSteps()
        );
    }

    #[Test]
    public function testReplacesVariablesRegardlessCasing(): void
    {
        $originalFood = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : [
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

        $food = $this->sut->process($originalFood);

        $this->assertEquals(
            [
                'cut 4 db onions',
                'peal 1 db avocado',
                'add 1 dl beer',
                'cook',
                'serve',
            ],
            $food->cookingSteps()
        );
    }

    #[Test]
    public function testReplacesVariablesOfReferences(): void
    {
        $originalFood = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : [
                'Fűszerezzük {{bors}} borssal',
            ],
            ingredients   : [
                new IngredientForFood('Fekete bors', 'test', 3, Measure::EK, reference: new Ingredient('Bors', 'test')),
            ]
        );

        $food = $this->sut->process($originalFood);

        $this->assertEquals(
            [
                'Fűszerezzük 3 ek borssal',
            ],
            $food->cookingSteps()
        );
    }

    #[Test]
    public function testDoesNotReplacesVariablesRecusively(): void
    {
        // TODO: add recursive [peter.pecosz]
        $originalFood = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : [
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

        $food = $this->sut->process($originalFood);

        $this->assertEquals(
            [
                'cut 4 db onions',
                [
                    'peal {{avocado}} avocado',
                ],
                'cook',
                'serve',
            ],
            $food->cookingSteps()
        );
    }
}
