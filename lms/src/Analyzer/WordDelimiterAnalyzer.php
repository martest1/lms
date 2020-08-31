<?php

declare(strict_types=1);

namespace App\Analyzer;

class WordDelimiterAnalyzer implements TextAnalyzerInterface
{
    public function extract(string $text) : array {
        return explode(' ', $text);
    }
}
