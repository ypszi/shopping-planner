<?php

declare(strict_types=1);

use PeterPecosz\Kajatervezo\Etel\Factory\EtelekFactory;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomor;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigTest;

require_once __DIR__ . '/../vendor/autoload.php';

$cacheEnabled = false;
$loader       = new FilesystemLoader(__DIR__ . '/../src/templates');
$twig         = new Environment($loader);
$twig->addTest(
    new TwigTest('string', static function ($value): bool {
        return is_string($value);
    })
);
$twig->addTest(
    new TwigTest('array', static function ($value): bool {
        return is_array($value);
    })
);

if ($cacheEnabled) {
    $twig = new Environment($loader, [
        'cache' => __DIR__ . '/../var/cache/',
    ]);
}

$etelekFactory = new EtelekFactory(
    __DIR__ . '/foods.yaml',
    __DIR__ . '/ingredients.yaml',
    __DIR__ . '/ingredientCategories.yaml'
);

$plannedShopping = $_GET;
if (!empty($plannedShopping['supermarket'])) {
    $supermarket = SupermarketFactory::create($plannedShopping['supermarket']);

    $foodPortionsByFoodName = [];
    foreach ($plannedShopping as $key => $value) {
        if (str_contains($key, 'food-')) {
            $foodKey                           = str_replace('food-', '', $key);
            $foodName                          = str_replace('_', ' ', $foodKey);
            $foodPortionsByFoodName[$foodName] = (int)$plannedShopping['portion-' . $foodKey];
        }
    }

    $etelek              = $etelekFactory->create($foodPortionsByFoodName);
    $shoppingList        = $supermarket->toShoppingList($etelek)->filterEmptyColumns();
    $shoppingListByFood  = $supermarket->toShoppingListByFood($etelek)->filterEmptyColumns();
    $totalRowCountByFood = array_sum(array_map(fn(array $rowsOfFood) => count($rowsOfFood), $shoppingListByFood->getRows()));

//    foreach ($etelek->toArray()[0]->comments() as $comment) {
//        // TODO: remove [peter.pecosz]
//        var_dump($comment);
//        var_dump(is_array($comment));
//        if (is_array($comment)) {
//            foreach ($comment as $subComment) {
//                // TODO: remove [peter.pecosz]
//                var_dump($subComment);
//            }
//        }
//    }
//    die;
    echo $twig->render('planned-shopping.html.twig', [
        'httpHost'            => $_SERVER['HTTP_HOST'],
        'supermarket'         => $supermarket,
        'etelek'              => $etelek,
        'shoppingList'        => $shoppingList,
        'shoppingListByFood'  => $shoppingListByFood,
        'totalRowCountByFood' => $totalRowCountByFood,
    ]);

    return;
}

$availableSupermarkets = array_combine(
    range(1, count(SupermarketFactory::listAvailableSupermarkets())),
    array_values(SupermarketFactory::listAvailableSupermarkets())
);

$availableFoods = $etelekFactory->createAvailableFoods();

echo $twig->render('shopping-planner.html.twig', [
    'defaultSupermarketName' => AuchanCsomor::name(),
    'availableSupermarkets'  => $availableSupermarkets,
    'availableFoods'         => $availableFoods,
]);
