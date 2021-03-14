<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayItem;
use PHPUnit\Framework\TestCase;

class SagepayItemTest extends TestCase
{
    /**
     * Get unique product identifier code
     *
     * @return string
     */
    public function testGetProductCode()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setProductCode($string);
        self::assertSame($string, $sagepayItem->getProductCode());
    }

    /**
     * Get first address line of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientAdd1()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientAdd1($string);
        self::assertSame($string, $sagepayItem->getRecipientAdd1());
    }

    /**
     * Get second address line of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientAdd2()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientAdd2($string);
        self::assertSame($string, $sagepayItem->getRecipientAdd2());
    }

    /**
     * Get code for the state of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientState()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientState($string);
        self::assertSame($string, $sagepayItem->getRecipientState());
    }

    /**
     * Get unique product identifier code
     *
     * @return string
     */
    public function testGetProductSku()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setProductSku($string);
        self::assertSame($string, $sagepayItem->getProductSku());
    }

    /**
     * Get gift message associated with this item
     *
     * @return string
     */
    public function testGetItemGiftMsg()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setItemGiftMsg($string);
        self::assertSame($string, $sagepayItem->getItemGiftMsg());
    }

    /**
     * Get first name of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientFName()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientFName($string);
        self::assertSame($string, $sagepayItem->getRecipientFName());
    }

    /**
     * Get last name of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientLName()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientLName($string);
        self::assertSame($string, $sagepayItem->getRecipientLName());
    }

    /**
     * Get middle initial of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientMName()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientMName($string);
        self::assertSame($string, $sagepayItem->getRecipientMName());
    }

    /**
     * Get email of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientEmail()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientEmail($string);
        self::assertSame($string, $sagepayItem->getRecipientEmail());
    }

    /**
     * Get city of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientCity()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientCity($string);
        self::assertSame($string, $sagepayItem->getRecipientCity());
    }

    /**
     * Get description
     *
     * @return string
     */
    public function testGetDescription()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setDescription($string);
        self::assertSame($string, $sagepayItem->getDescription());
    }

    /**
     * Get country code of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientCountry()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientCountry($string);
        self::assertSame($string, $sagepayItem->getRecipientCountry());
    }

    /**
     * Get shipping item number
     *
     * @return string
     */
    public function testGetItemShipNo()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setItemShipNo($string);
        self::assertSame($string, $sagepayItem->getItemShipNo());
    }

    /**
     * Get salutation of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientSal()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientSal($string);
        self::assertSame($string, $sagepayItem->getRecipientSal());
    }

    public function testGetRecipientPostCode()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientPostCode($string);
        self::assertSame($string, $sagepayItem->getRecipientPostCode());
    }

    /**
     * Get phone number of the recipient of this item
     *
     * @return string
     */
    public function testGetRecipientPhone()
    {
        $sagepayItem = new SagepayItem();
        $string = "xyz";
        $sagepayItem->setRecipientPhone($string);
        self::assertSame($string, $sagepayItem->getRecipientPhone());
    }

    /**
     * Return a array of the item properties
     *
     * @return array
     */
    public function testAsArray()
    {
        $sagepayItem = new SagepayItem();
        $array = $sagepayItem->asArray();
        self::assertIsArray($array);
        self::assertNotEmpty($array);
    }
}
