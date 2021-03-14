<?php

namespace Classes;

use Xigen\Library\Sagepay\Payment;
use PHPUnit\Framework\TestCase;

class SagepayServerApiTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * Get vpsServerUrl
     *
     * @return string
     */
    public function testGtVpsServerUrl()
    {
        $payment = new Payment(Payment::SERVER);
        $api = $payment->getApi();
        $vpsDirectUrl = $api->getVpsServerUrl();
        $url = 'https://test.sagepay.com/gateway/service/vspserver-register.vsp';
        self::assertIsString($vpsDirectUrl);
        self::assertSame($vpsDirectUrl, $url);

        $liveUrl = 'https://live.sagepay.com/gateway/service/vspserver-register.vsp';
        $api->setVpsServerUrl($liveUrl);
        $vpsDirectUrl = $api->getVpsServerUrl();
        self::assertIsString($vpsDirectUrl);
        self::assertSame($vpsDirectUrl, $liveUrl);
    }

    /**
     * @see SagepayAbstractApi::getQueryData()
     * @return null
     */
    public function testGetQueryData()
    {
        $payment = new Payment(Payment::SERVER);
        $api = $payment->getApi();
        $queryData = $api->getQueryData();
        self::assertEmpty($queryData);
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
        $payment = new Payment(Payment::SERVER);
        $api = $payment->getApi();
        $api->createRequest();
    }
}
