<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core;

enum Environment: string
{
    case dev = 'dev';
    case prod = 'prod';
}
