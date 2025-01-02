<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Drugs;
use Symfony\Component\Yaml\Yaml;

readonly class DrugsFactory
{
    /** @var array<string, array<string, mixed>> */
    private array $drugs;

    public function __construct(
        private DrugFactory $drugFactory,
        string $drugsPath
    ) {
        $this->drugs = Yaml::parseFile($drugsPath);
    }

    /**
     * @param array<string, int> $drugPortionsByDrugName
     */
    public function create(array $drugPortionsByDrugName): Drugs
    {
        $drugs = new Drugs();

        foreach ($drugPortionsByDrugName as $drugName => $portion) {
            $drug = $this->drugs[$drugName] ?? null;

            if (!isset($drug)) {
                continue;
            }

            $drug = $this->drugFactory->createWithPortion($drugName, $portion);

            $drugs->add($drug);
        }

        return $drugs;
    }
}
