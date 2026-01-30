<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Tests\Unit\Food;

use PeterPecosz\ShoppingPlanner\Food\Food;
use PeterPecosz\ShoppingPlanner\Food\TemplatingProcessor;
use PeterPecosz\ShoppingPlanner\Ingredient\Ingredient;
use PeterPecosz\ShoppingPlanner\Ingredient\IngredientForFood;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class TemplatingProcessorTest extends TestCase
{
    private TemplatingProcessor $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new TemplatingProcessor(new ExpressionLanguage());
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

    #[Test]
    public function testMathCanBeDoneInVariables(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion / 2}} onions',
                'peal {{ avocado * 0.5 }} avocado',
                'pour {{wine (dry) + 1}} wine',
                'cut {{onion - 2}} more onions',
                'peal {{ avocado * 0.5 }} more avocado',
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
                'cut 2 db onions',
                'peal 0.5 db avocado',
                'pour 2 dl wine',
                'cut 2 db more onions',
                'peal 0.5 db more avocado',
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testMultiOperandMathCanBeDoneInVariables(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion / 3}} onions',
                'cut {{onion / 3 * 2}} more onions',
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 3, Measure::DB),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 1 db onions',
                'cut 2 db more onions',
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testMathFailsInVariablesWhenTotalDoesNotAddUp(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion / 2}} onions',
                'peal {{ avocado * 0.5 }} avocado',
                'pour {{wine (dry) + 1}} wine',
                'cut {{onion - 3}} more onions',
                'peal {{ avocado * 0.5 }} more avocado',
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 4, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
                new IngredientForFood('wine (dry)', 'drink', 1, Measure::DL),
            ]
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Total does not add up for: "onion"; expected "4.00", got "3.00"');

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 2 db onions',
                'peal 0.5 db avocado',
                'pour 2 dl wine',
                'cut 1 db more onions',
                'peal 0.5 db more avocado',
                'cook',
                'serve',
            ],
            $result
        );
    }

    #[Test]
    public function testMathPassesInVariablesWhenTotalDoesAddUpForTwoDecimalPrecision(): void
    {
        $food = new Food(
            name          : 'test food',
            defaultPortion: 4,
            cookingSteps  : $cookingSteps = [
                'cut {{onion * 0.33}} onions',
                'peal {{ avocado * 0.5 }} avocado',
                'pour {{wine (dry) + 1}} wine',
                'cut {{onion * 0.66}} more onions',
                'peal {{ avocado * 0.5 }} more avocado',
                'cook',
                'serve',
            ],
            ingredients   : [
                new IngredientForFood('onion', 'vegetable', 3, Measure::DB),
                new IngredientForFood('avocado', 'fruit', 1, Measure::DB),
                new IngredientForFood('wine (dry)', 'drink', 1, Measure::DL),
            ]
        );

        $result = $this->sut->process($food, $cookingSteps);

        $this->assertEquals(
            [
                'cut 1 db onions',
                'peal 0.5 db avocado',
                'pour 2 dl wine',
                'cut 2 db more onions',
                'peal 0.5 db more avocado',
                'cook',
                'serve',
            ],
            $result
        );
    }
}
