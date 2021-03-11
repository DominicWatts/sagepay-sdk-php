<?php


use Xigen\Library\Sagepay\Constants;
use PHPUnit\Framework\TestCase;

class ConstantsTest extends TestCase
{
    public function test__construct()
    {
        $constants = new Constants();
        self::assertIsObject($constants);
    }
}
