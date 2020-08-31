<?php

declare(strict_types=1);

namespace App\Service;

interface SortInterface
{
    public function sort(array $data) : array;
}
