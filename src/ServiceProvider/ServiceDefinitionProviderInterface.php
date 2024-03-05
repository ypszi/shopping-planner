<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\ServiceProvider;

interface ServiceDefinitionProviderInterface
{
    /**
     * @return array<string, mixed>
     */
    public function getDefinitions(): array;
}
