<?php

declare(strict_types=1);

use App\Filter\WhitespaceFilter;
use PHPUnit\Framework\TestCase;

class WhitespaceFilterTest extends TestCase
{
    /** @var WhitespaceFilter */
    private $filter;

    /**
     * @group filters
     * @dataProvider stringProvider
     */
    public function testWhitespaceFilterShouldReturnStringWithoutMoreThanOneSpace($value, $expected)
    {
        $this->assertEquals(
            $this->filter->filter($value),
            $expected,
            'Whitespace Filter failed to filter spaces');
    }

    public function setUp()
    {
        $this->filter = new WhitespaceFilter();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function stringProvider()
    {
        return [
            ['TesTF,   TesT    tEst', 'TesTF, TesT tEst'],
            ['AcF d4S TEE      EEEst!', 'AcF d4S TEE EEEst!'],
            ['teeeest', 'teeeest'],
        ];
    }
}
