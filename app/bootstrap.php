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

if ($_GET['planned'] ?? false) {
    unset($_GET['planned']);

    $plannedShopping = $_GET;
    $supermarket     = SupermarketFactory::create($plannedShopping['supermarket']);

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

    echo $twig->render('planned-shopping.html.twig', [
        'supermarket'         => $supermarket,
        'etelek'              => $etelek,
        'shoppingList'        => $shoppingList,
        'shoppingListByFood'  => $shoppingListByFood,
        'totalRowCountByFood' => $totalRowCountByFood,
        'plannedShopping'     => http_build_query($plannedShopping),
    ]);

    return;
}

$availableSupermarkets = array_combine(
    range(1, count(SupermarketFactory::listAvailableSupermarkets())),
    array_values(SupermarketFactory::listAvailableSupermarkets())
);

$availableFoods     = $etelekFactory->createAvailableFoods();
$defaultSupermarket = $_GET['supermarket'] ?? AuchanCsomor::name();

unset($_GET['supermarket']);

$foods         = array_filter($_GET, fn(string $key) => str_contains($key, 'food-'), ARRAY_FILTER_USE_KEY);
$portions      = array_filter($_GET, fn(string $key) => str_contains($key, 'portion-'), ARRAY_FILTER_USE_KEY);
$selectedFoods = [];

foreach ($foods as $key => $value) {
    $portionKey            = str_replace('food-', 'portion-', $key);
    $selectedFoods[$value] = $portions[$portionKey];
}

echo $twig->render('shopping-planner.html.twig', [
    'defaultSupermarket'    => $defaultSupermarket,
    'availableSupermarkets' => $availableSupermarkets,
    'availableFoods'        => $availableFoods,
    'selectedFoods'         => $selectedFoods,
]);
