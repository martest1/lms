<?php

declare(strict_types=1);

namespace App\Filter;


class WhitespaceFilter implements TextFilterInterface
{
    public function filter(string $text) : string {
        $text = preg_replace('/\s+/u', ' ', $text);
        return trim($text);
    }
}
