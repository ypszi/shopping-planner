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
    <style media="all">
		label.form-check-label {
			font-weight: 600;
		}

		output {
			font-size: 0.7rem;
			vertical-align: text-bottom;
		}

		button#plan-btn {
			margin-bottom: 1rem;
		}

		button#back-btn {
			margin-bottom: 1rem;
		}
    </style>
</head>
<body>
<div class="container-fluid">
    <?php if (empty($_POST)): ?>
        <form action="" method="post" class="row">
            <fieldset class="row mb-2">
                <legend class="col-form-label col-md-12 pt-0">
                    <span class="display-6">Hova mész bevásárolni?</span>
                </legend>
                <?php foreach ($availableSupermarkets as $availableSupermarket): ?>
                    <?php $availableSupermarketKey = str_replace(' ', '_', $availableSupermarket); ?>
                    <div class="col-md-12">
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
                <legend class="col-form-label col-md-12 pt-0">
                    <span class="display-6">Melyik kajákhoz kell bevásárolni?</span>
                </legend>
                <?php foreach ($availableFoodNames as $availableFoodName): ?>
                    <?php $availableFoodNameKey = str_replace(' ', '_', $availableFoodName); ?>
                    <?php $etel = EtelFactory::create($availableFoodName); ?>
                    <div class="col-md-8">
                        <div class="form-check form-switch">
                            <input
                                type="checkbox"
                                role="switch"
                                id="<?= $availableFoodNameKey ?>"
                                value="<?= $availableFoodName ?>"
                                name="food-<?= $availableFoodNameKey ?>"
                                class="form-check-input"
                                onchange="this.checked ? document.getElementById('portion-<?= $availableFoodNameKey ?>').disabled = '' : document.getElementById('portion-<?= $availableFoodNameKey ?>').disabled = 'disabled'"
                            >
                            <label for="<?= $availableFoodNameKey ?>" class="form-check-label"><?= $availableFoodName ?></label>
                            <output id="portion-output-<?= $availableFoodNameKey ?>">(<?= $etel::defaultAdag() ?> Adag)</output>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                                oninput="document.getElementById('portion-output-<?= $availableFoodNameKey ?>').value = '(' + this.value + ' Adag)'"
                            >
                        </div>
                    </div>
                <?php endforeach; ?>
            </fieldset>

            <div class="sticky-bottom">
                <div class="row justify-content-center">
                    <button class="btn btn-primary col-2" type="submit" id="plan-btn">PLAN</button>
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
                    <th scope="col">Kommentek</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($etelek->toArray() as $etel): ?>
                    <tr>
                        <td><?= $etel ?></td>
                        <td><a href="<?= $etel->receptUrl(); ?>" target="_blank"><?= $etel->receptUrl(); ?></a></td>
                        <td>
                            <?php foreach ($etel->comments() as $comment): ?>
                                <li><?= $comment ?></li>
                            <?php endforeach; ?>
                        </td>
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
                <button class="btn btn-secondary col-2" type="button" id="back-btn" onclick="location.href=''">BACK</button>
            </div>
        </div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
