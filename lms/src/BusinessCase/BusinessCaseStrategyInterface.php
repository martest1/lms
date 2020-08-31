<?php

declare(strict_types=1);

namespace App\BusinessCase;

interface BusinessCaseStrategyInterface
{
    public function solve() : ?BusinessCaseStrategyInterface;

    public function setData($data) : ?BusinessCaseStrategyInterface;

    public function returnResult();
}
