<?php

declare(strict_types=1);

namespace App\Filter;

interface TextFilterInterface
{
    public function filter(string $text) : string;
}
