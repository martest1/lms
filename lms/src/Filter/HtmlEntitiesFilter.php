<?php

declare(strict_types=1);

namespace App\Filter;


class HtmlEntitiesFilter implements TextFilterInterface
{
    public function filter(string $text) : string {
        return $text = strip_tags($text);
    }
}
