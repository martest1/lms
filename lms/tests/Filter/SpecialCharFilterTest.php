<?php

declare(strict_types=1);

use App\Filter\SpecialCharFilter;
use PHPUnit\Framework\TestCase;

class SpecialCharFilterText extends TestCase
{
    /** @var SpecialCharFilter */
    private $filter;

    /**
     * @group filters
     * @dataProvider stringProvider
     */
    public function testSpecialCharFilterShouldReturnStringWithoutSpecialChars($value, $expected)
    {
        $this->assertEquals(
            $this->filter->filter($value),
            $expected,
            'Special Char Filter failed to filter special chars');
    }

    public function setUp()
    {
        $this->filter = new SpecialCharFilter();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function stringProvider()
    {
        return [
            ['test; test!', 'test  test '],
            ['aa2a,aa bbbb?', 'aa2a aa bbbb '],
            ['teeeest', 'teeeest'],
        ];
    }
}
