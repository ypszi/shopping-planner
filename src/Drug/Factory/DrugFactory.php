<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Drug;
use PeterPecosz\ShoppingPlanner\Drug\DrugCategory;
use PeterPecosz\ShoppingPlanner\Drug\DrugForShopping;
use PeterPecosz\ShoppingPlanner\Drug\Exception\UnknownDrugException;
use PeterPecosz\ShoppingPlanner\Measure\Measure;
use Symfony\Component\Yaml\Yaml;

readonly class DrugFactory
{
    private const DEFAULT_MAX  = 5;
    private const DEFAULT_STEP = 1;

    /** @var array<string, array<string, string>> */
    private array $drugs;

    /** @var array<string, array<string, string>> */
    private array $drugCategories;

    public function __construct(
        string $drugsPath,
        string $drugCategoriesPath
    ) {
        $this->drugs          = Yaml::parseFile($drugsPath);
        $this->drugCategories = Yaml::parseFile($drugCategoriesPath);
    }

    /**
     * @throws UnknownDrugException
     */
    public function createWithPortion(
        string $drugName,
        float $portion
    ): DrugForShopping {
        $drug = $this->create($drugName);

        return new DrugForShopping(
            name:              $drug->name(),
            category:          $drug->category(),
            portion:           $portion,
            measure:           null,
            measurePreference: $drug->measurePreference()
        );
    }

    /**
     * @throws UnknownDrugException
     */
    public function create(string $drugName): Drug
    {
        $drug = $this->drugs[$drugName] ?? null;

        if (!isset($drug)) {
            throw new UnknownDrugException(sprintf('Drug was not found: "%s"', $drugName));
        }

        if (is_string($drugRefName = $this->drugs[$drugName] ?? null)) {
            $drugRef = $this->drugs[$drugRefName] ?? null;

            if (!$drugRef) {
                throw new UnknownDrugException(
                    sprintf('Drug reference not found: "%s"', $drugRefName)
                );
            }

            $drugName = $drugRefName;
            $drug     = $drugRef;
        }

        $defaultDrug       = $this->drugs[$drugName] ?? [];
        $category          = $drug['kategoria'] ?? $defaultDrug['kategoria'] ?? null;
        $measurePreference = $drug['mertekegysegPreference']
                             ?? $defaultDrug['mertekegysegPreference']
                                ?? $this->drugCategories[$category]['mertekegysegPreference']
                                   ?? null;

        if (!$category) {
            throw new UnknownDrugException(
                sprintf('Drug not found: "%s"', $drugName)
            );
        }

        if ($category !== $defaultDrug['kategoria']) {
            throw new UnknownDrugException(
                sprintf(
                    'Drug category mismatch for "%s": "%s" - "%s"',
                    $drugName,
                    $drug['kategoria'],
                    $defaultDrug['kategoria']
                )
            );
        }

        if ($defaultDrug && !isset($this->drugCategories[$defaultDrug['kategoria']])) {
            throw new UnknownDrugException(
                sprintf(
                    'Drug category not found for "%s": "%s"',
                    $drugName,
                    $defaultDrug['kategoria']
                )
            );
        }

        if ($measurePreference && !$drugMeasurePreference = Measure::tryFrom($measurePreference)) {
            throw new UnknownDrugException(
                sprintf(
                    'Drug measurement not found for "%s": "%s"',
                    $drugName,
                    $measurePreference
                )
            );
        }

        $drugCategory = $this->drugCategories[$category] ?? null;
        $storageSetup = $drugCategory['storage'] ?? [];

        return new Drug(
            name:              $drugName,
            category:          new DrugCategory(
                                   name:        $category,
                                   storageMax:  $drug['storage']['max'] ?? $storageSetup['max'] ?? self::DEFAULT_MAX,
                                   storageStep: $drug['storage']['step'] ?? $storageSetup['step'] ?? self::DEFAULT_STEP
                               ),
            measurePreference: $drugMeasurePreference ?? null
        );
    }
}
