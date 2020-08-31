<?php

declare(strict_types=1);

namespace App\Filter;


class DigitFilter implements TextFilterInterface
{
    public function filter(string $text) : string {
        return $text = preg_replace('/\d+/', ' ', $text);
    }
}
