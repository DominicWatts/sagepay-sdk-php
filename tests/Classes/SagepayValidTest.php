<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayValid;
use PHPUnit\Framework\TestCase;

class SagepayValidTest extends TestCase
{
    /**
     * Checks if a field is not empty.
     *
     * @param string $input Description
     *
     * @return  boolean
     */
    public function testNotEmpty()
    {
        $result = SagepayValid::notEmpty('');
        self::assertFalse($result);

        $result = SagepayValid::notEmpty('xyz');
        self::assertTrue($result);
    }

    /**
     * Checks a field against a regular expression.
     *
     * @param   string  $input      value
     * @param   string  $regexp regular expression to match (including delimiters)
     *
     * @return  boolean
     */
    public function testRegex()
    {
        $result = SagepayValid::regex('test', '/xyz/');
        self::assertFalse($result);

        $result = SagepayValid::regex('test', '/test/');
        self::assertTrue($result);
    }

    /**
     * Checks that a field is greater or equal with minimum required.
     *
     * @param   string  $input  value
     * @param   integer $length minimum length required
     *
     * @return  boolean
     */
    public function testMinLength()
    {
        $result = SagepayValid::minLength('xyz', 4);
        self::assertFalse($result);

        $result = SagepayValid::minLength('xyz', 2);
        self::assertTrue($result);
    }

    /**
     * Checks that a field is less or equal with maximum required
     *
     * @param   string  $input  value
     * @param   integer $length maximum length required
     *
     * @return  boolean
     */
    public function testMaxLength()
    {
        $result = SagepayValid::maxLength('xyz', 2);
        self::assertFalse($result);

        $result = SagepayValid::maxLength('xyz', 4);
        self::assertTrue($result);
    }

    /**
     * Checks that a number is within a range.
     *
     * @param   string  $input number to check
     * @param   integer $minValue    minimum value
     * @param   integer $maxValue    maximum value
     *
     * @return  boolean
     */
    public function testRange()
    {
        $result = SagepayValid::range(4, 1, 3);
        self::assertFalse($result);

        $result = SagepayValid::range(2, 1, 3);
        self::assertTrue($result);
    }

    /**
     * Checks that a field have exact length.
     *
     * @param   string          $input  value
     * @param   integer|array   $length exact length required, or array of valid lengths
     *
     * @return  boolean
     */
    public function testExactLength()
    {
        $result = SagepayValid::exactLength('xyz', 4);
        self::assertFalse($result);

        $result = SagepayValid::exactLength('xyz', 3);
        self::assertTrue($result);

        $result = SagepayValid::exactLength('xyz', [4, 5]);
        self::assertFalse($result);

        $result = SagepayValid::exactLength('xyz', [2, 3]);
        self::assertTrue($result);
    }

    /**
     * Checks that a field is same as required.
     *
     * @param   string  $input      original value
     * @param   string  $expected   expected value
     *
     * @return  boolean
     */
    public function testEquals()
    {
        $result = SagepayValid::equals('2', 2);
        self::assertFalse($result);

        $result = SagepayValid::equals(1, 2);
        self::assertFalse($result);

        $result = SagepayValid::equals(3, 3);
        self::assertTrue($result);
    }

    /**
     * Check an email address for valid format.
     *
     * @param   string  $input  email address
     *
     * @return  boolean
     */
    public function testEmail()
    {
        $result = SagepayValid::email('testattest.com');
        self::assertFalse($result);

        $result = SagepayValid::email('');
        self::assertTrue($result);

        $result = SagepayValid::email('test@test.com');
        self::assertTrue($result);
    }

    /**
     * Check an URL for valid format.
     *
     * @param   string  $input  URL
     *
     * @return  boolean
     */
    public function testUrl()
    {
        $result = SagepayValid::url('test@test.com');
        self::assertFalse($result);

        $result = SagepayValid::url('testattest.com');
        self::assertFalse($result);

        $result = SagepayValid::url('http://testattest.com');
        self::assertTrue($result);
    }

    /**
     * Validates a credit card number with luhn checksum
     *
     * @param   integer         $input credit card number
     *
     * @return  boolean
     */
    public function testCreditCard()
    {
        $result = SagepayValid::creditCard('79927398710');
        self::assertFalse($result);

        $result = SagepayValid::creditCard('79927398719');
        self::assertFalse($result);
    }

    /**
     * Validate a number against the Luhn checksum
     *
     * @link http://en.wikipedia.org/wiki/Luhn_algorithm
     * @param   string  $input number to check
     *
     * @return  boolean
     */
    public function testLuhn()
    {
        $result = SagepayValid::luhn('abc');
        self::assertFalse($result);

        $result = SagepayValid::luhn('79927398710');
        self::assertFalse($result);

        $result = SagepayValid::luhn('79927398719');
        self::assertFalse($result);
    }

    /**
     * Checks whether a string consists of digits only.
     *
     * @param   string  $input    input string
     *
     * @return  boolean
     */
    public function testDigit()
    {
        $result = SagepayValid::digit('123t');
        self::assertFalse($result);

        $result = SagepayValid::digit('123');
        self::assertTrue($result);
    }

    /**
     * Checks whether a string is a valid number.
     *
     * @param   string  $input    input string
     *
     * @return  boolean
     */
    public function testNumeric()
    {
        $result = SagepayValid::numeric('123t');
        self::assertFalse($result);

        $result = SagepayValid::numeric('123');
        self::assertTrue($result);
    }

    /**
     * Checks if a string is a proper decimal format.
     *
     * @param   string  $input    number to check
     * @param   integer $places number of decimal places
     *
     * @return  boolean
     */
    public function testDecimal()
    {
        $result = SagepayValid::decimal(12, 2);
        self::assertFalse($result);

        $result = SagepayValid::decimal(12.3, 2);
        self::assertFalse($result);

        $result = SagepayValid::decimal(number_format(12.3, 1), 2);
        self::assertFalse($result);

        $result = SagepayValid::decimal(number_format(123.00, 2), 2);
        self::assertTrue($result);
    }
}
