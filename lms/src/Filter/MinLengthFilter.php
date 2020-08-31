<?php

declare(strict_types=1);

namespace App\Filter;


class MinLengthFilter implements TextFilterInterface
{
    private const MIN_LENGTH = 3;

    public function filter(string $text) : string {
        if (mb_strlen($text) < self::MIN_LENGTH) {
            return '';
        }
        return $text;
    }
}
