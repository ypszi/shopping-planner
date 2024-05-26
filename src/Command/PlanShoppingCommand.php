<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Command;

use Override;
use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Etelek;
use PeterPecosz\Kajatervezo\Etel\Factory\EtelFactory;
use PeterPecosz\Kajatervezo\ShoppingList\ShoppingList;
use PeterPecosz\Kajatervezo\Supermarket\KauflandTrier\KauflandTrier;
use PeterPecosz\Kajatervezo\Supermarket\Supermarket;
use PeterPecosz\Kajatervezo\Supermarket\SupermarketFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PlanShoppingCommand extends Command
{
    private Supermarket $supermarket;

    private Etelek $etelek;

    private SymfonyStyle $io;

    /** @var string[] */
    private array $availableSupermarkets;

    /** @var string[] */
    private array $availableFoodNames;

    protected function configure(): void
    {
        $this->availableSupermarkets = array_combine(range(1, count(SupermarketFactory::listAvailableSupermarkets())), array_values(SupermarketFactory::listAvailableSupermarkets()));
        $this->availableFoodNames    = array_combine(range(1, count(EtelFactory::listAvailableEtelek())), array_values(EtelFactory::listAvailableEtelek()));

        $this
            ->setName('plan:shopping')
            ->setDescription('Megtervezi a hozzávalók bevásárlását')
            ->addOption('testing', 't')
            ->addOption('supermarket', 's', InputArgument::OPTIONAL, 'Name of supermarket to go to', null, $this->availableSupermarkets)
            ->addOption('foods', 'f', InputArgument::OPTIONAL, 'List of food names to prepare for', null, $this->availableFoodNames);
    }

    #[Override] protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->etelek = new Etelek();
        $this->io     = new SymfonyStyle($input, $output);

        $this->io->title('BEVÁSÁRLÁS TERVEZŐ');
    }

    #[Override] protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $supermarketName   = $this->askSupermarketName($input);
        $this->supermarket = SupermarketFactory::create($supermarketName);

        if ($input->getOption('testing')) {
            $this->prepareTestingRunEtelek();

            return;
        }

        $foodNames = $this->askFoodNames($input);

        $this->prepareEtelek($foodNames);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->renderSupermarket();

        $this->renderEtelek();

        $shoppingList = $this->supermarket->toShoppingList($this->etelek);

        $this->renderHozzavalok($shoppingList);

        return Command::SUCCESS;
    }

    private function prepareTestingRunEtelek(): void
    {
        foreach (EtelFactory::listAvailableEtelek() as $etelName) {
            $this->etelek->add(EtelFactory::create($etelName));
        }
    }

    /**
     * @param string[] $foodNames
     */
    public function prepareEtelek(array $foodNames): void
    {
        foreach ($foodNames as $kajaName) {
            $etel = EtelFactory::create($kajaName);
            $adag = (int)$this->io->ask(
                sprintf('Hány adagot készítesz ebből: "%s"?', $kajaName),
                (string)$etel::defaultAdag()
            );

            $this->etelek->add($etel->withAdag($adag));
        }
    }

    private function askSupermarketName(InputInterface $input): string
    {
        return trim($input->getOption('supermarket'))
            ?: $this->io->choice(
                question: 'Hova mész bevásárolni?',
                choices: $this->availableSupermarkets,
                default: KauflandTrier::name()
            );
    }

    /**
     * @return string[]
     */
    private function askFoodNames(InputInterface $input): array
    {
        /** @var string[] $foodNames */
        return array_map('trim', explode(',', $input->getOption('foods') ?? ''))
            ?: $this->io->choice(
                question: 'Melyik kajákhoz kell bevásárolni?',
                choices: $this->availableFoodNames,
                multiSelect: true
            );
    }

    public function renderSupermarket(): void
    {
        $this->io->section('Bevásárlóközpont:');
        $this->io->text($this->supermarket::name());
    }

    private function renderEtelek(): void
    {
        $this->io->section('Ételek:');
        $this->io->table(
            ['Étel', 'Recept'],
            array_map(fn(Etel $etel) => [(string)$etel, $etel->receptUrl()], $this->etelek->toArray())
        );
    }

    public function renderHozzavalok(ShoppingList $shoppingList): void
    {
        $this->io->section('Hozzávalók:');
        $this->io->table(
            $shoppingList->getHeader(),
            $shoppingList->getRows()
        );
    }
}
