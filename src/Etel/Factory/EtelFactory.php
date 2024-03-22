<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel\Factory;

use PeterPecosz\Kajatervezo\Etel\BundasCsirke;
use PeterPecosz\Kajatervezo\Etel\ChilisBab;
use PeterPecosz\Kajatervezo\Etel\CitromosJoghurtosCsirkemell;
use PeterPecosz\Kajatervezo\Etel\CitromosSpargasCsirkesPenne;
use PeterPecosz\Kajatervezo\Etel\Csirkemellpaprikas;
use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Exception\UnknownEtelException;
use PeterPecosz\Kajatervezo\Etel\KefiresCsirke;
use PeterPecosz\Kajatervezo\Etel\KinaiSzezammagosCsirke;
use PeterPecosz\Kajatervezo\Etel\PorehagymaLeves;
use PeterPecosz\Kajatervezo\Etel\Porkolt;
use PeterPecosz\Kajatervezo\Etel\Rizskoch;
use PeterPecosz\Kajatervezo\Etel\SertesPorkolt;
use PeterPecosz\Kajatervezo\Etel\TarkonyosCsirkeraguLeves;
use PeterPecosz\Kajatervezo\Etel\ToltottKaposzta;

class EtelFactory
{
    public static function create(string $name): Etel
    {
        $etelClass = self::etelMap()[$name] ?? null;

        if (!$etelClass) {
            throw new UnknownEtelException(sprintf('Unknown etel found: "%s"', $name));
        }

        return new $etelClass();
    }

    public static function createWithAdag(string $name, int $adag): Etel
    {
        $etelClass = self::etelMap()[$name] ?? null;

        if (!$etelClass) {
            throw new UnknownEtelException(sprintf('Unknown etel found: "%s"', $name));
        }

        return new $etelClass(adag: $adag);
    }

    /**
     * @return array<string, string>
     */
    public static function etelMap(): array
    {
        return [
            BundasCsirke::getName()                => BundasCsirke::class,
            ChilisBab::getName()                   => ChilisBab::class,
            CitromosJoghurtosCsirkemell::getName() => CitromosJoghurtosCsirkemell::class,
            CitromosSpargasCsirkesPenne::getName() => CitromosSpargasCsirkesPenne::class,
            Csirkemellpaprikas::getName()          => Csirkemellpaprikas::class,
            KefiresCsirke::getName()               => KefiresCsirke::class,
            KinaiSzezammagosCsirke::getName()      => KinaiSzezammagosCsirke::class,
            PorehagymaLeves::getName()             => PorehagymaLeves::class,
            Porkolt::getName()                     => Porkolt::class,
            Rizskoch::getName()                    => Rizskoch::class,
            SertesPorkolt::getName()               => SertesPorkolt::class,
            TarkonyosCsirkeraguLeves::getName()    => TarkonyosCsirkeraguLeves::class,
            ToltottKaposzta::getName()             => ToltottKaposzta::class,
        ];
    }
}
