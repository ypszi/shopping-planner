<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Command;

use PeterPecosz\Kajatervezo\Etel\Factory\EtelFactory;
use PeterPecosz\Kajatervezo\Hozzavalo\Etelek;
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
            ->setDescription('Megtervezi a hozzávalók bevásárlását');
    }

    #[\Override] protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->etelek = new Etelek();
        $this->io     = new SymfonyStyle($input, $output);

        $this->io->title('BEVÁSÁRLÁS TERVEZŐ');
    }

    #[\Override] protected function interact(InputInterface $input, OutputInterface $output): void
    {
        /** @var string[] $kajaNevek */
        $kajaNevek = $this->io->choice(
            question:    'Melyik kajákhoz kell bevásárolni?',
            choices:     array_keys(EtelFactory::etelMap()),
            multiSelect: true
        );

        foreach ($kajaNevek as $kajaNev) {
            $adag = (int)$this->io->ask(
                sprintf('Hány adagot főzöl ebből: "%s"?', $kajaNev),
                (string)EtelFactory::create($kajaNev)::getDefaultAdag()
            );

            $this->etelek->add(EtelFactory::createWithAdag($kajaNev, $adag));
        }

        $this->io->table(
            ['Ételek'],
            array_map(fn(string $etel) => [$etel], $this->etelek->toArray())
        );
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
}
