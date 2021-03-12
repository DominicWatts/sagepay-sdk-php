<?php

namespace Classes;

use Xigen\Library\Sagepay\Payment;
use PHPUnit\Framework\TestCase;

class SagepayFormApiTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * Return urlencoded string based on data
     *
     * @return string
     */
    public function testGetQueryData()
    {
        $payment = new Payment(Payment::FORM);
        $api = $payment->getApi();
        $string = "query=test";
        $api->updateData(['query' => 'test']);
        $queryData = $api->getQueryData();
        self::assertNotEmpty($queryData);
        self::assertIsString($queryData);
        self::assertSame($string, $queryData);
    }

    /**
     * Generate values for payment.
     * Ensure that post data is setted to request with SagepayAbstractApi::setData()
     *
     * @see SagepayAbstractApi::createRequest()
     * @return array The response from Sage Pay
     */
    public function testCreateRequest()
    {
        $this->expectError();
        $payment = new Payment(Payment::FORM);
        $api = $payment->getApi();
        $api->createRequest();
    }
}
