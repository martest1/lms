<?php

declare(strict_types=1);

namespace App\BusinessCase;

class BusinessCase implements BusinessCaseInterface
{
    private const REGISTERED_STRATEGIES = [
        'calculate_number_of_words_in_text',
    ];

    public function getBusinessCase(string $strategy_type) : ?BusinessCaseStrategyInterface
    {
        if (in_array($strategy_type, self::REGISTERED_STRATEGIES)) {
            switch($strategy_type) {
                case 'calculate_number_of_words_in_text':
                    return new CalculateNumberOfWordsBusinessCase();
                break;
            }
        }
        return null;
    }
}
