<?php


use Xigen\Library\Sagepay\Classes\SagepayCustomer;
use PHPUnit\Framework\TestCase;

class SagepayCustomerTest extends TestCase
{
    /**
     * Get work phone number of the customer.
     *
     * @return string
     */
    public function testGetCustomerWorkPhone()
    {
        $customer = new SagepayCustomer();
        $string = "xyz";
        $customer->setCustomerWorkPhone($string);
        self::assertSame($string, $customer->getCustomerWorkPhone());
    }

    /**
     * Get customer ID
     *
     * @return string
     */
    public function testGetCustomerId()
    {
        $customer = new SagepayCustomer();
        $string = "xyz";
        $customer->setCustomerId($string);
        self::assertSame($string, $customer->getCustomerId());
    }

    /**
     * Get the number of days since the card was first seen.
     *
     * @return int
     */
    public function testGetTimeOnFile()
    {
        $customer = new SagepayCustomer();
        $string = "1";
        $customer->setTimeOnFile($string);
        self::assertSame((int) $string, $customer->getTimeOnFile());
    }

    /**
     * Get mobile number of the customer
     *
     * @return string
     */
    public function testGetCustomerMobilePhone()
    {
        $customer = new SagepayCustomer();
        $string = "xyz";
        $customer->setCustomerMobilePhone($string);
        self::assertSame($string, $customer->getCustomerMobilePhone());
    }

    /**
     * Get is a previous customer
     *
     * @return int
     */
    public function testGetPreviousCust()
    {
        $customer = new SagepayCustomer();
        $string = "1";
        $customer->setPreviousCust($string);
        self::assertSame((int) $string, $customer->getPreviousCust());
    }

    /**
     * Get date of birth of the customer
     *
     * @return string
     */
    public function testGetCustomerBirth()
    {
        $customer = new SagepayCustomer();
        $string = "xyz";
        $customer->setCustomerBirth($string);
        self::assertSame($string, $customer->getCustomerBirth());
    }

    /**
     * Get middle initial of the customer
     *
     * @return string
     */
    public function testGetCustomerMiddleInitial()
    {
        $customer = new SagepayCustomer();
        $string = "xyz";
        $customer->setCustomerMiddleInitial($string);
        self::assertSame($string, $customer->getCustomerMiddleInitial());
    }

    /**
     * Export customer details as XML string
     *
     * @return string XML with customer details
     */
    public function testExport()
    {
        $customer = new SagepayCustomer();
        self::assertIsString($customer->export());
        self::assertXmlStringEqualsXmlString('<customer/>', $customer->export());
    }
}
