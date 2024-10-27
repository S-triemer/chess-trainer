<?php
namespace chessBackend\tests\unit;

use chessBackend\InvalidJsonKeysException;
use PHPUnit\Framework\TestCase;

class InvalidJsonKeysExceptionTest extends TestCase
{
    public function testDefaultExceptionMessage()
    {
        $exception = new InvalidJsonKeysException();
        
        $this->assertEquals("Invalid JSON keys provided", $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
    }

    public function testCustomExceptionMessage()
    {
        $customMessage = "Custom error message";
        $exception = new InvalidJsonKeysException($customMessage);
        
        $this->assertEquals($customMessage, $exception->getMessage());
        $this->assertEquals(400, $exception->getCode());
    }
}
