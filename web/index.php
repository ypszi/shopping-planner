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
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <?php if (empty($_POST)): ?>
        <form action="" method="post" class="row">
            <fieldset class="row mb-2">
                <legend class="col-form-label col-sm-12 pt-0">
                    <span class="display-6">Hova mész bevásárolni?</span>
                </legend>
                <?php foreach ($availableSupermarkets as $availableSupermarket): ?>
                    <?php $availableSupermarketKey = str_replace(' ', '_', $availableSupermarket); ?>
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input
                                type="radio"
                                id="<?= $availableSupermarketKey ?>"
                                value="<?= $availableSupermarket ?>"
                                name="supermarket"
                                class="form-check-input"
                                <?php if ($availableSupermarket === KauflandTrier::name()): ?>checked=checked<?php endif; ?>
                            >
                            <label for="<?= $availableSupermarketKey ?>" class="form-check-label">
                                <?= $availableSupermarket ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </fieldset>

            <fieldset class="row mb-2">
                <legend class="col-form-label col-sm-12 pt-0">
                    <span class="display-6">Melyik kajákhoz kell bevásárolni?</span>
                </legend>
                <?php foreach ($availableFoodNames as $availableFoodName): ?>
                    <?php $availableFoodNameKey = str_replace(' ', '_', $availableFoodName); ?>
                    <div class="col-sm-6 mb-2">
                        <div class="form-check">
                            <input
                                type="checkbox"
                                id="<?= $availableFoodNameKey ?>"
                                value="<?= $availableFoodName ?>"
                                name="food-<?= $availableFoodNameKey ?>"
                                class="form-check-input"
                                onchange="this.checked ? document.getElementById('portion-<?= $availableFoodNameKey ?>').disabled = '' : document.getElementById('portion-<?= $availableFoodNameKey ?>').disabled = 'disabled'"
                            >
                            <label for="<?= $availableFoodNameKey ?>" class="form-check-label"><?= $availableFoodName ?></label>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <?php $etel = EtelFactory::create($availableFoodName); ?>
                        <div class="input-group">
                            <input
                                type="range"
                                id="portion-<?= $availableFoodNameKey ?>"
                                value="<?= $etel::defaultAdag() ?>"
                                name="portion-<?= $availableFoodNameKey ?>"
                                class="form-range"
                                min="1"
                                max="12"
                                step="1"
                                disabled="disabled"
                                oninput="document.getElementById('portion-output-<?= $availableFoodNameKey ?>').value = this.value + ' Adag'"
                            >
                        </div>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <output class="input-group-text" id="portion-output-<?= $availableFoodNameKey ?>"><?= $etel::defaultAdag() ?> Adag</output>
                    </div>
                <?php endforeach; ?>
            </fieldset>

            <div class="sticky-bottom">
                <div class="row justify-content-center">
                    <button class="btn btn-primary col-2" type="submit" style="margin-bottom: 1rem;">PLAN</button>
                </div>
            </div>
        </form>
    <?php else: ?>
        <h3 class="text-success">Bevásárlóközpont:</h3>
        <p><?= $supermarket::name() ?></p>

        <h3 class="text-success">Ételek (<?= count($etelek->toArray()) ?> db):</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Étel</th>
                    <th scope="col">Recept</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($etelek->toArray() as $etel): ?>
                    <tr>
                        <td><?= $etel; ?></td>
                        <td><a href="<?= $etel->receptUrl(); ?>"><?= $etel->receptUrl(); ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3 class="text-success">Hozzávalók (<?= count($shoppingList->getRows()) ?> sor):</h3>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <?php foreach ($shoppingList->getHeader() as $header): ?>
                        <th scope="col"><?= $header ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($shoppingList->getRows() as $row): ?>
                    <tr>
                        <?php foreach ($row as $col): ?>
                            <td><?= $col ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="sticky-bottom">
            <div class="row justify-content-center">
                <button class="btn btn-secondary col-2" type="button" style="margin-bottom: 1rem;" onclick="location.href=''">BACK</button>
            </div>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
