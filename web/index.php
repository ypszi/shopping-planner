<?php

declare(strict_types=1);

use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelFactory;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;

include_once __DIR__ . '/../vendor/autoload.php';

$availableSupermarkets = array_combine(
    range(1, count(SupermarketFactory::listAvailableSupermarkets())),
    array_values(SupermarketFactory::listAvailableSupermarkets())
);

$availableFoodNames = array_combine(
    range(1, count(EtelFactory::listAvailableEtelek())),
    array_values(EtelFactory::listAvailableEtelek())
);

if (!empty($_POST)) {
    $supermarketName = $_POST['supermarket'];
    $supermarket     = SupermarketFactory::create($supermarketName);

    unset($_POST['supermarket']);

    $foodNames = [];
    foreach ($_POST as $key => $value) {
        if (str_contains($key, 'food-')) {
            $foodKey              = str_replace('food-', '', $key);
            $foodName             = str_replace('_', ' ', $foodKey);
            $foodNames[$foodName] = (int)$_POST['portion-' . $foodKey];
        }
    }

    $etelek = new Etelek();
    foreach ($foodNames as $kajaName => $adag) {
        $etel = EtelFactory::create($kajaName);

        $etelek->add($etel->withAdag($adag));
    }

    $shoppingList = $supermarket->toShoppingList($etelek);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BEVÁSÁRLÁS TERVEZŐ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <?php if (empty($_POST)): ?>
        <form action="" method="post" class="row">
            <fieldset class="row mb-2">
                <legend class="col-form-label col-sm-12 pt-0">Hova mész bevásárolni?</legend>
                <?php foreach ($availableSupermarkets as $availableSupermarket): ?>
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input
                                type="radio"
                                id="<?= $availableSupermarket ?>"
                                value="<?= $availableSupermarket ?>"
                                name="supermarket"
                                class="form-check-input"
                                <?php if ($availableSupermarket === KauflandTrier::name()): ?>checked=checked<?php endif; ?>
                            >
                            <label for="<?= $availableSupermarket ?>" class="form-check-label">
                                <?= $availableSupermarket ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </fieldset>

            <fieldset class="row mb-2">
                <legend class="col-form-label col-sm-12 pt-0">Melyik kajákhoz kell bevásárolni?</legend>
                <?php foreach ($availableFoodNames as $availableFoodName): ?>
                    <div class="col-sm-10 mb-2">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                id="<?= $availableFoodName ?>"
                                value="<?= $availableFoodName ?>"
                                name="food-<?= $availableFoodName ?>"
                                class="form-check-input"
                            >
                            <label for="<?= $availableFoodName ?>" class="form-check-label"><?= $availableFoodName ?></label>
                        </div>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <?php $etel = EtelFactory::create($availableFoodName); ?>
                        <div class="input-group">
                            <input
                                type="number"
                                id="portion-<?= $availableFoodName ?>"
                                value="<?= $etel::defaultAdag() ?>"
                                name="portion-<?= $availableFoodName ?>"
                                class="form-control"
                            >
                            <span class="input-group-text" id="portion-<?= $availableFoodName ?>">Adag</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </fieldset>


            <div class="col-12">
                <button class="btn btn-primary" type="submit">PLAN</button>
            </div>
        </form>
    <?php else: ?>
        <h1>Bevásárlóközpont:</h1>
        <p><?= $supermarket::name() ?></p>

        <h1>Ételek:</h1>
        <table class="table">
            <tr>
                <th scope="col">Étel</th>
                <th scope="col">Recept</th>
            </tr>
            <?php foreach ($etelek->toArray() as $etel): ?>
                <tr>
                    <td>
                        <?= $etel; ?>
                    </td>
                    <td>
                        <a href="<?= $etel->receptUrl(); ?>"><?= $etel->receptUrl(); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>


        <h1>Hozzávalók:</h1>
        <table class="table">
            <tr>
                <?php foreach ($shoppingList->getHeader() as $header): ?>
                    <th scope="col"><?= $header ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($shoppingList->getRows() as $row): ?>
                <tr>
                    <?php foreach ($row as $col): ?>
                        <td>
                            <?= $col ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>

        <button type="reset" onclick="location.href=''" class="btn btn-secondary">BACK</button>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
