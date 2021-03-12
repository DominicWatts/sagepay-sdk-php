<?php

namespace Classes;

use Xigen\Library\Sagepay\Payment;
use PHPUnit\Framework\TestCase;

class SagepayDirectApiTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * Get vpsDirectUrl
     *
     * @return string
     */
    public function testGetVpsDirectUrl()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $vpsDirectUrl = $api->getVpsDirectUrl();
        $url = 'https://test.sagepay.com/gateway/service/vspdirect-register.vsp';
        self::assertIsString($vpsDirectUrl);
        self::assertSame($vpsDirectUrl, $url);

        $liveUrl = 'https://live.sagepay.com/gateway/service/vspdirect-register.vsp';
        $api->setVpsDirectUrl($liveUrl);
        $vpsDirectUrl = $api->getVpsDirectUrl();
        self::assertIsString($vpsDirectUrl);
        self::assertSame($vpsDirectUrl, $liveUrl);
    }

    public function testSetIntegrationMethod()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $api->setIntegrationMethod(Payment::DIRECT);
        $integrationMethod = $api->getIntegrationMethod();
        self::assertIsString($integrationMethod);
        self::assertSame($integrationMethod, Payment::DIRECT);
    }

    /**
     * @see SagepayAbstractApi::getQueryData()
     * @return null
     */
    public function testGetQueryData()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $queryData = $api->getQueryData();
        self::assertEmpty($queryData);
    }
}
