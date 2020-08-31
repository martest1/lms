<?php

declare(strict_types=1);

namespace App\Filter;

class LowerCaseFilter implements TextFilterInterface
{
    public function filter(string $text) : string {
        return strtolower($text);
    }
}
