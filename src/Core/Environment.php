<?php

declare(strict_types=1);

namespace PeterPecosz\Kajatervezo\Core;

enum Environment: string
{
    case dev = 'dev';
    case prod = 'prod';
}
