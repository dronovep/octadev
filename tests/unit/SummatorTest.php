<?php

namespace mapp\tests\unit;

use Codeception\Test\Unit;
use mapp\util\Summator;

class SummatorTest extends Unit
{

    public function testSumIntegers()
    {
        $summator = new Summator();
        $this->assertEquals(5, $summator->sumIntegers(3, 2));
    }
}
