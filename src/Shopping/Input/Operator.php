<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Shopping\Input;

enum Operator: string
{
    case AND = 'AND';
    case OR = 'OR';
}
