<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Drug\Factory;

use PeterPecosz\ShoppingPlanner\Drug\Drug;
use Symfony\Component\Yaml\Yaml;

readonly class AvailableDrugFactory
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
     * @return Drug[]
     */
    public function listAvailableDrugs(): array
    {
        $availableDrugs = [];
        foreach ($this->drugs as $drugName => $drug) {
            $availableDrugs[] = $this->drugFactory->create($drugName);
        }

        return $availableDrugs;
    }
}
