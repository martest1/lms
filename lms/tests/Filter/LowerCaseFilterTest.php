<?php

declare(strict_types=1);

use App\Filter\LowerCaseFilter;
use PHPUnit\Framework\TestCase;

class LowerCaseFilterTest extends TestCase
{
    /** @var LowerCaseFilter */
    private $filter;

    /**
     * @group filters
     * @dataProvider stringProvider
     */
    public function testLowerCaseFilterShouldReturnStringWithoutUppercase($value, $expected)
    {
        $this->assertEquals(
            $this->filter->filter($value),
            $expected,
            'Lower Case Filter failed to filter upper cases');
    }

    public function setUp()
    {
        $this->filter = new LowerCaseFilter();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function stringProvider()
    {
        return [
            ['TesTF, TesT  tEst', 'testf, test  test'],
            ['AcF d4S TEEEEEst!', 'acf d4s teeeeest!'],
            ['teeeest', 'teeeest'],
        ];
    }
}
