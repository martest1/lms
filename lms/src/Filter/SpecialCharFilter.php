<?php

declare(strict_types=1);

namespace App\Filter;


class SpecialCharFilter implements TextFilterInterface
{
    private const FILTERED = [
        ',', '!', '.', ':', ';', '?', '_', '-', '~', '"', '\'',
    ];

    public function filter(string $text) : string {
        foreach (self::FILTERED as $charToBeFiltered) {
            $text = str_replace($charToBeFiltered, ' ', $text);
        }
        return $text;
    }
}
