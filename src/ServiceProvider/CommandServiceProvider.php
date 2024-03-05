<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\ServiceProvider;

use PeterPecosz\Kajatervezo\Command\KajatervezoCommand;

use function DI\autowire;

class CommandServiceProvider implements ServiceDefinitionProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getDefinitions(): array
    {
        return [
            KajatervezoCommand::class => autowire(),
        ];
    }
}
