<?php

declare(strict_types=1);

namespace App\BusinessCase;

interface BusinessCaseInterface
{
    public function getBusinessCase(string $strategy_type) : ?BusinessCaseStrategyInterface;
}
