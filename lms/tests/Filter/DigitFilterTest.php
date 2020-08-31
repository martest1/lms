<?php

declare(strict_types=1);

use App\Filter\DigitFilter;
use PHPUnit\Framework\TestCase;

class DigitFilterTest extends TestCase
{
    /** @var DigitFilter */
    private $filter;

    /**
     * @group filters
     * @dataProvider stringProvider
     */
    public function testDigitFilterShouldReturnStringWithoutDigits($value, $expected)
    {
        $this->assertEquals(
            $this->filter->filter($value),
            $expected,
            'Digit Filter failed to filter digits');
    }

    public function setUp()
    {
        $this->filter = new DigitFilter();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function stringProvider()
    {
        return [
            ['asdas faf ad34 fds74 dfadf24', 'asdas faf ad  fds  dfadf '],
            ['aaaaa bbbb111 ccc3333 22321 da2', 'aaaaa bbbb  ccc    da '],
            ['asdsfadsff adsf dsf adsf sdaf s', 'asdsfadsff adsf dsf adsf sdaf s'],
        ];
    }
}
