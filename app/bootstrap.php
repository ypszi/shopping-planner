<?php

declare(strict_types=1);

use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelFactory;
use PeterPecosz\Kajatervezo\Supermarket\AuchanCsomor\AuchanCsomor;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

$cacheEnabled = false;
$loader       = new FilesystemLoader(__DIR__ . '/../src/templates');
$twig         = new Environment($loader);

if ($cacheEnabled) {
    $twig = new Environment($loader, [
        'cache' => __DIR__ . '/../var/cache/',
    ]);
}

$plannedShopping = $_GET;
if (!empty($plannedShopping['supermarket'])) {
    $supermarket = SupermarketFactory::create($plannedShopping['supermarket']);

    $foodNames = [];
    foreach ($plannedShopping as $key => $value) {
        if (str_contains($key, 'food-')) {
            $foodKey              = str_replace('food-', '', $key);
            $foodName             = str_replace('_', ' ', $foodKey);
            $foodNames[$foodName] = (int)$plannedShopping['portion-' . $foodKey];
        }
    }

    $etelek = new Etelek();
    foreach ($foodNames as $foodName => $adag) {
        $etel = EtelFactory::create($foodName);

        $etelek->add($etel->withAdag($adag));
    }

    $shoppingList        = $supermarket->toShoppingList($etelek)->filterEmptyColumns();
    $shoppingListByFood  = $supermarket->toShoppingListByFood($etelek)->filterEmptyColumns();
    $totalRowCountByFood = array_sum(array_map(fn(array $rowsOfFood) => count($rowsOfFood), $shoppingListByFood->getRows()));

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

$availableFoodNames = array_combine(
    range(1, count(EtelFactory::listAvailableEtelek())),
    array_values(EtelFactory::listAvailableEtelek())
);

$availableFoods = [];

foreach ($availableFoodNames as $availableFoodName) {
    $availableFoods[] = EtelFactory::create($availableFoodName);
}

echo $twig->render('shopping-planner.html.twig', [
    'defaultSupermarketName' => AuchanCsomor::name(),
    'availableSupermarkets'  => $availableSupermarkets,
    'availableFoodNames'     => $availableFoodNames,
    'availableFoods'         => $availableFoods,
]);
