<?php
// tests/unit/SampleTest.php

use PHPUnit\Framework\TestCase;

class SampleTest extends TestCase
{
    public function testBasicAssertions()
    {
        // This will always pass
        $this->assertTrue(true);
    }

    public function testAddition()
    {
        $this->assertEquals(2, 1 + 1);
    }
}
