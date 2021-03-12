<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayCommon;
use PHPUnit\Framework\TestCase;

class SagepayCommonTest extends TestCase
{
    /**
     * Generate a unique VendorTxId
     *
     * @param string $orderId Order ID.
     * @param string $type    Type of transaction
     * @param string $prefix  Override the prefix
     *
     * @return string Returns a unique string that can be used as VendorTxId
     */
    public function testVendorTxCode()
    {
        $code = '123';
        $txCode = SagepayCommon::vendorTxCode($code);
        self::assertNotSame($txCode, $code);
        self::assertIsString($txCode);
    }

    /**
     * Extract an order id from a VendorTxCode
     *
     * @param string $vendorTxCode a valid VendorTxCode
     *
     * @return boolean|string Returns the Order Id or boolean false
     */
    public function testVendorTxCode2OrderId()
    {
        $code = '123';
        $txCode = '123-344153076';
        $orderId = SagepayCommon::vendorTxCode2OrderId($txCode);
        self::assertNotSame($code, $txCode);
        self::assertSame($code, $orderId);
        self::assertIsString($orderId);
    }
}
