<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Command;

use RuntimeException;
use Symfony\Component\Yaml\Yaml;

class YamlFormatter
{
    public function format(string $yamlPath): void
    {
        if (!is_file($yamlPath)) {
            throw new RuntimeException('Yaml path is not a file: ' . $yamlPath);
        }

        file_put_contents(
            $yamlPath,
            Yaml::dump(
                input : Yaml::parseFile($yamlPath),
                inline: 6,
                flags : Yaml::DUMP_COMPACT_NESTED_MAPPING
            )
        );
    }
}
