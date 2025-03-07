<?php

declare(strict_types=1);

namespace PeterPecosz\ShoppingPlanner\Core\Url;

use GuzzleHttp\Psr7\Uri;
use Throwable;

class Url
{
    public static function isUrl(mixed $candidate): bool
    {
        if (!is_string($candidate)) {
            return false;
        }

        try {
            $uri = new Uri($candidate);
        } catch (Throwable) {
            return false;
        }

        return !empty($uri->getHost());
    }
}
