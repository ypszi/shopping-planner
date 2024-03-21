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

class KajatervezoCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('plan:shopping')
            ->setDescription('Megtervezi a hozzávalók bevásárlását');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('BEVÁSÁRLÁS TERVEZŐ');

        /** @var string[] $kajaNevek */
        $kajaNevek = $io->choice(
            question:    'Melyik kajákhoz kell bevásárolni?',
            choices:     array_keys(EtelFactory::etelMap()),
            multiSelect: true
        );

        $etelek = new Etelek();
        foreach ($kajaNevek as $kajaNev) {
            $adag = (int)$io->ask(
                sprintf('Hány adagot főzöl ebből: "%s"?', $kajaNev),
                (string)EtelFactory::create($kajaNev)::getDefaultAdag()
            );

            $etelek->add(EtelFactory::createWithAdag($kajaNev, $adag));
        }

        $io->table(
            ['Ételek'],
            array_map(fn(string $etel) => [$etel], $etelek->toArray())
        );

        $io->writeln('Hozzávalók:');
        $io->table(
            HozzavaloKategoria::SORREND,
            $etelek->createHozzavaloSorok()->toArray()
        );

        return Command::SUCCESS;
    }
}
