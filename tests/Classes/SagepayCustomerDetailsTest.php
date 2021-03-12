<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayCustomerDetails;
use PHPUnit\Framework\TestCase;

class SagepayCustomerDetailsTest extends TestCase
{
    /**
     * Writing data to inaccessible properties
     *
     * @param string $name
     * @param string $value
     */
    public function testMagicSetter()
    {
        $cardDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $cardDetails->__set('firstname', $string);
        self::assertSame($string, $cardDetails->getFirstname());
    }

    /**
     * Get city
     *
     * @return string
     */
    public function testGetCity()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setCity($string);
        self::assertSame($string, $sagepayCustomerDetails->getCity());
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function testGetAddress2()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setAddress2($string);
        self::assertSame($string, $sagepayCustomerDetails->getAddress2());
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function testGetLastname()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setLastname($string);
        self::assertSame($string, $sagepayCustomerDetails->getLastname());
    }

    public function testValidate()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setPostcode($string);
        $errors = $sagepayCustomerDetails->validate();
        self::assertIsArray($errors);
        self::assertNotEmpty($errors);

    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function testGetFirstname()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setFirstname($string);
        self::assertSame($string, $sagepayCustomerDetails->getFirstname());
    }

    /**
     * Validate Zip Code for UK only
     *
     * @param string $value
     *
     * @return boolean
     */
    public function testNotEmptyZipCodeUK()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "GB";
        $sagepayCustomerDetails->setCountry($string);
        $notEmpty = $sagepayCustomerDetails->notEmptyZipCodeUK($string);
        self::assertSame($notEmpty, true);
        self::assertIsBool($notEmpty);
    }

    /**
     * Get default postcode if the address supplied didn't have one
     *
     * @param string $default   The default value to use when not found or empty
     *
     * @return string
     */
    public function testGetPostCode()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setPostcode($string);
        self::assertSame($string, $sagepayCustomerDetails->getPostCode());
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function testGetPhone()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setPhone($string);
        self::assertSame($string, $sagepayCustomerDetails->getPhone());
    }

    /**
     * Get country
     *
     * @param string $country
     */
    public function testGetCountry()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setCountry($string);
        self::assertSame($string, $sagepayCustomerDetails->getCountry());
    }

    public function testGetState()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setState($string);
        self::assertSame($string, $sagepayCustomerDetails->getState());
    }

    /**
     * Get state
     *
     * @param string $state
     */
    public function testValidUsa()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "US";
        $sagepayCustomerDetails->setCountry($string);
        $notEmpty = $sagepayCustomerDetails->validUsa($string);
        self::assertSame($notEmpty, true);
        self::assertIsBool($notEmpty);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function testGetEmail()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setEmail($string);
        self::assertSame($string, $sagepayCustomerDetails->getEmail());
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function testGetAddress1()
    {
        $sagepayCustomerDetails = new SagepayCustomerDetails();
        $string = "xyz";
        $sagepayCustomerDetails->setAddress1($string);
        self::assertSame($string, $sagepayCustomerDetails->getAddress1());
    }
}
