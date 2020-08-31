<?php

declare(strict_types=1);

namespace App\BusinessCase;


use App\Filter\DigitFilter;
use App\Filter\HtmlEntitiesFilter;
use App\Filter\LowerCaseFilter;
use App\Filter\MinLengthFilter;
use App\Analyzer\TextAnalyzerInterface;
use App\Analyzer\WordDelimiterAnalyzer;
use App\Filter\SpecialCharFilter;
use App\Filter\WhitespaceFilter;
use App\Service\SortByWordCountDescWordAsc;
use App\Service\SortInterface;

class CalculateNumberOfWordsBusinessCase implements BusinessCaseStrategyInterface
{

    /** @var string */
    private $data = '';

    /** @var array */
    private $result = [];

    /** @var  DigitFilter */
    private $digitFilter;

    /** @var HtmlEntitiesFilter */
    private $htmlEntitiesFilter;

    /** @var LowerCaseFilter  */
    private $lowerCaseFilter;

    /** @var MinLengthFilter  */
    private $minLengthFilter;

    /** @var SpecialCharFilter */
    private $specialCharFilter;

    /** @var WhitespaceFilter */
    private $whitespaceFilter;

    /** @var WordDelimiterAnalyzer  */
    private $wordDelimiterAnalyzer;

    /** @var SortInterface */
    private $sorter;

    public function __construct(
        // This should be provided other way (i.e. in some kind of provided options object), because there are too many constructor parameters.
        // For the sake and simplicity of 'interview task' I will just leave it as it is
        TextAnalyzerInterface $digitFilter = null,
        TextAnalyzerInterface $htmlEntitiesFilter = null,
        TextAnalyzerInterface $lowerCaseFilter = null,
        TextAnalyzerInterface $minLengthFilter = null,
        TextAnalyzerInterface $specialCharFilter = null,
        TextAnalyzerInterface $whitespaceFilter = null,
        TextAnalyzerInterface $wordDelimiterAnalyzer = null,
        SortInterface $sorter = null
        )
    {
        if (empty($this->digitFilter)) {
            $this->digitFilter = new DigitFilter();
        }
        if (empty($this->htmlEntitiesFilter)) {
            $this->htmlEntitiesFilter = new HtmlEntitiesFilter();
        }
        if (empty($this->lowerCaseFilter)) {
            $this->lowerCaseFilter = new LowerCaseFilter();
        }
        if (empty($this->minLengthFilter)) {
            $this->minLengthFilter = new MinLengthFilter();
        }
        if (empty($this->specialCharFilter)) {
            $this->specialCharFilter = new SpecialCharFilter();
        }
        if (empty($this->whitespaceFilter)) {
            $this->whitespaceFilter = new WhitespaceFilter();
        }
        if (empty($this->wordDelimiterAnalyzer)) {
            $this->wordDelimiterAnalyzer = new WordDelimiterAnalyzer();
        }
        if (empty($this->sorter)) {
            $this->sorter = new SortByWordCountDescWordAsc();
        }
    }

    public function solve() : ?BusinessCaseStrategyInterface
    {
        // lowercase
        $filteredData = $this->lowerCaseFilter->filter($this->data);

        // digit remove
        $filteredData = $this->digitFilter->filter($filteredData);

        // HTML entities remove
        $filteredData = $this->htmlEntitiesFilter->filter($filteredData);

        // special char remove
        $filteredData = $this->specialCharFilter->filter($filteredData);

        // whitespace
        $filteredData = $this->whitespaceFilter->filter($filteredData);

        // extract words
        $extractedWords = $this->wordDelimiterAnalyzer->extract($filteredData);
        $filteredWords = [];
        foreach ($extractedWords as $word) {
            $acceptedWord = $this->minLengthFilter->filter($word);
            if (!empty($acceptedWord)) {
                $filteredWords[] = $acceptedWord;
            }
        }

        // sort
        $this->result = $this->sorter->sort($filteredWords);

        return $this;
    }

    public function setData($data) : ?BusinessCaseStrategyInterface
    {
        $this->data = $data;
        return $this;
    }

    public function returnResult()
    {
        return $this->result;
    }
}
