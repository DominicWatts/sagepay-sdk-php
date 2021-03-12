<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayCardDetails;
use PHPUnit\Framework\TestCase;

class SagepayCardDetailsTest extends TestCase
{
    /**
     * Get gift aid
     * @return string
     */
    public function testGetGiftAid()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setGiftAid($string);
        self::assertSame($string, $cardDetails->getGiftAid());
    }

    /**
     * Get Card cv2
     * @return string
     */
    public function testGetCv2()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setCv2($string);
        self::assertSame($string, $cardDetails->getCv2());
    }

    /**
     * Writing data to inaccessible properties
     *
     * @param string $name
     * @param string $value
     */
    public function testMagicSetter()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->__set('cardHolder', $string);
        self::assertSame($string, $cardDetails->getCardHolder());
    }

    public function testValidate()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setCardNumber($string);
        $errors = $cardDetails->validate();
        self::assertIsArray($errors);
        self::assertNotEmpty($errors);
    }

    /**
     * Get Card holder
     * @return string
     */
    public function testGetCardHolder()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setCardHolder($string);
        self::assertSame($string, $cardDetails->getCardHolder());
    }

    /**
     * Get Card expiry
     * @return string
     */
    public function testGetExpiryDate()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setExpiryDate($string);
        self::assertSame($string, $cardDetails->getExpiryDate());
    }

    /**
     * Get Card type
     * @return string
     */
    public function testGetCardType()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setCardType($string);
        self::assertSame($string, $cardDetails->getCardType());
    }

    /**
     * Get Card type
     * @return string
     */
    public function testGetCardNumber()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setCardNumber($string);
        self::assertSame($string, $cardDetails->getCardNumber());
    }

    /**
     * Get Card start
     * @return string
     */
    public function testGetStartDate()
    {
        $cardDetails = new SagepayCardDetails();
        $string = "xyz";
        $cardDetails->setStartDate($string);
        self::assertSame($string, $cardDetails->getStartDate());
    }
}
