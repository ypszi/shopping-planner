<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Etel\Factory;

use FilesystemIterator;
use PeterPecosz\Kajatervezo\Etel\Etel;
use PeterPecosz\Kajatervezo\Etel\Exception\UnknownEtelException;
use ReflectionClass;
use ReflectionException;
use SplFileInfo;

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
     * @return array<string, string> Where key is the name of the Etel and the value is the FQCN of the Etel
     */
    public static function etelMap(): array
    {
        $etelMap = [];
        $etelDir = new FilesystemIterator(__DIR__ . '/../');

        /** @var SplFileInfo $etelFile */
        foreach ($etelDir as $etelFile) {
            $etelClassName = str_replace('.' . $etelFile->getExtension(), '', $etelFile->getBasename());
            $etelFqcn      = preg_replace('/^([\w\\\\]+)(\\\\\w+)$/', '${1}\\', __NAMESPACE__) . $etelClassName;

            try {
                $etelReflection = new ReflectionClass($etelFqcn);
            } catch (ReflectionException) {
                continue;
            }

            if (self::isEtel($etelReflection)) {
                try {
                    $etelMap[$etelReflection->getMethod('getName')->invoke($etelReflection)] = $etelFqcn;
                } catch (ReflectionException) {
                    continue;
                }
            }
        }

        return $etelMap;
    }

    private static function isEtel(ReflectionClass $reflectionClass): bool
    {
        if ($reflectionClass->getParentClass()) {
            if ($reflectionClass->getParentClass()->getName() === Etel::class) {
                return true;
            }

            return self::isEtel($reflectionClass->getParentClass());
        }

        return false;
    }
}
