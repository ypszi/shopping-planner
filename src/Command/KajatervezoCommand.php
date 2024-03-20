<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Command;

use PeterPecosz\Kajatervezo\Etel\BundasCsirke;
use PeterPecosz\Kajatervezo\Etel\CitromosJoghurtosCsirkemell;
use PeterPecosz\Kajatervezo\Etel\CitromosSpargasCsirkesPenne;
use PeterPecosz\Kajatervezo\Etel\Csirkemellpaprikas;
use PeterPecosz\Kajatervezo\Etel\KefiresCsirke;
use PeterPecosz\Kajatervezo\Etel\KinaiSzezammagosCsirke;
use PeterPecosz\Kajatervezo\Etel\PorehagymaLeves;
use PeterPecosz\Kajatervezo\Etel\Rizskoch;
use PeterPecosz\Kajatervezo\Etel\ToltottKaposzta;
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
            ->setName('kajakat:tervezz')
            ->setDescription('Megtervezi a bevásárlás hozzávalóit');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('KAJA TERVEZŐ');

        $etelek = new Etelek(
            [
                new BundasCsirke(),
                new CitromosJoghurtosCsirkemell(),
                new CitromosSpargasCsirkesPenne(),
                new Csirkemellpaprikas(),
                new KefiresCsirke(),
                new KinaiSzezammagosCsirke(),
                new PorehagymaLeves(adag: 8),
                new Rizskoch(),
                new ToltottKaposzta(adag: 8),
            ]
        );

        $io->table(
            ['Ételek'],
            array_map(fn (string $etel) => [$etel], $etelek->toArray())
        );

        $io->writeln('Hozzávalók:');
        $io->table(
            HozzavaloKategoria::SORREND,
            $etelek->createHozzavaloSorok()->toArray()
        );

        return Command::SUCCESS;
    }
}
