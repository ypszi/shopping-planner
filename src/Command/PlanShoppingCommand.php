<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Command;

use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelFactory;
use PeterPecosz\Kajatervezo\Hozzavalo\HozzavaloKategoria;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PlanShoppingCommand extends Command
{
    private Etelek $etelek;

    private SymfonyStyle $io;

    protected function configure(): void
    {
        $this
            ->setName('plan:shopping')
            ->setDescription('Megtervezi a hozzávalók bevásárlását')
            ->addOption('testing', 't');
    }

    #[\Override] protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->etelek = new Etelek();
        $this->io     = new SymfonyStyle($input, $output);

        $this->io->title('BEVÁSÁRLÁS TERVEZŐ');
    }

    #[\Override] protected function interact(InputInterface $input, OutputInterface $output): void
    {
        if ($input->getOption('testing')) {
            $this->prepareTestingRun();

            return;
        }

        /** @var string[] $etelNames */
        $etelNames = array_keys(EtelFactory::etelMap());
        sort($etelNames);

        /** @var string[] $kajaNames */
        $kajaNames = $this->io->choice(
            question:    'Melyik kajákhoz kell bevásárolni?',
            choices:     $etelNames,
            multiSelect: true
        );

        foreach ($kajaNames as $kajaName) {
            $adag = (int)$this->io->ask(
                sprintf('Hány adagot főzöl ebből: "%s"?', $kajaName),
                (string)EtelFactory::create($kajaName)::defaultAdag()
            );

            $this->etelek->add(EtelFactory::createWithAdag($kajaName, $adag));
        }

        $this->renderEtelek();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io->writeln('Hozzávalók:');
        $this->io->table(
            HozzavaloKategoria::SORREND,
            $this->etelek->createHozzavaloSorok()->toArray()
        );

        return Command::SUCCESS;
    }

    private function prepareTestingRun(): void
    {
        /** @var string[] $etelNames */
        $etelNames = array_keys(EtelFactory::etelMap());
        sort($etelNames);

        foreach ($etelNames as $etelName) {
            $this->etelek->add(EtelFactory::create($etelName));
        }

        $this->renderEtelek();
    }

    private function renderEtelek(): void
    {
        $this->io->table(
            ['Étel', 'Recept'],
            array_map(fn(Etel $etel) => [(string)$etel, $etel->receptUrl()], $this->etelek->toArray())
        );
    }
}
