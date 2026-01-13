<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core;

enum Environment: string
{
    case Dev = 'dev';
    case Prod = 'prod';
}
