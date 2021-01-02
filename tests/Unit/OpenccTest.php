<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class OpenccTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $actual = opencc('我鼠標哪兒去了。');
        $this->assertEquals('我滑鼠哪兒去了。', $actual);
    }
}
