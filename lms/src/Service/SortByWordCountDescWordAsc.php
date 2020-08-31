<?php

declare(strict_types=1);

namespace App\Service;

class SortByWordCountDescWordAsc implements SortInterface
{
    public function sort(array $words) : array
    {
        // count words
        $counted_words = array_count_values($words);

        arsort($counted_words);

        $i = array_values($counted_words)[0] + 1;
        $same_number_of_entries = [];

        array_walk($counted_words, function($value, $key) use (&$i, &$same_number_of_entries) {
            if ($i > 0 && $value == $i) {
                $same_number_of_entries[$value][] = $key;
            } else {
                $i--;
                if ($i > 0 && $value == $i) {
                    $same_number_of_entries[$value][] = $key;
                }
            }
        });

        $final = [];
        foreach ($counted_words as $word => $count) {
            if (array_key_exists($count, $same_number_of_entries) && count($same_number_of_entries[$count]) > 1) {
                sort($same_number_of_entries[$count], SORT_STRING);
                foreach ($same_number_of_entries[$count] as $key => $value) {
                    $final[$value] = $count;
                }
            } else {
                $final[$word] = $count;
            }
        }
        return $final;
    }
}
