<?php

declare(strict_types=1);

namespace App\Analyzer;

interface TextAnalyzerInterface
{
    public function extract(string $text) : array;
}
