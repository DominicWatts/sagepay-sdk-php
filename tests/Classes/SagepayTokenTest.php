<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepaySettings;
use Xigen\Library\Sagepay\Classes\SagepayToken;
use PHPUnit\Framework\TestCase;
use Xigen\Library\Sagepay\Payment;

class SagepayTokenTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * Get URL for card remove [RFC1738 valid]
     *
     * @return string
     */
    public function testGetRemoveUrl()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $sagepaySettings = $api->getConfig();
        $url = 'https:://test.com';
        $sagepaySettings->setTokenUrl($url, 'remove', 'test');
        $sagepayToken = new SagepayToken($sagepaySettings);
        self::assertSame($url, $sagepayToken->getRemoveUrl());

        $sagepayToken = new SagepayToken($sagepaySettings);
        $sagepayToken->setRemoveUrl($url);
        self::assertSame($url, $sagepayToken->getRemoveUrl());
    }

    /**
     * Get URL for card registration [RFC1738 valid]
     *
     * @return string
     */
    public function testGetRegisterUrl()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $sagepaySettings = $api->getConfig();
        $url = 'https:://test.com';
        $sagepaySettings->setTokenUrl($url, 'register-direct', 'test');
        $sagepayToken = new SagepayToken($sagepaySettings);
        self::assertSame($url, $sagepayToken->getRegisterUrl());

        $sagepayToken = new SagepayToken($sagepaySettings);
        $sagepayToken->setRegisterUrl($url);
        self::assertSame($url, $sagepayToken->getRegisterUrl());
    }

    /**
     * Register card to Sagepay Service
     *
     * @param  string[]  $cardDetails  Associative array with card details
     *
     * @return string|null
     */
    public function testRegister()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $sagepaySettings = $api->getConfig();
        $sagepayToken = new SagepayToken($sagepaySettings);
        $array = [];
        $response = $sagepayToken->register($array);
        self::assertNull($response);
    }

    /**
     * Remove token from Sagepay Service
     *
     * @param  string  $token Token GUID provided by Sagepay service on card registration
     *
     * @return boolean
     */
    public function testRemove()
    {
        $payment = new Payment(Payment::DIRECT);
        $api = $payment->getApi();
        $sagepaySettings = $api->getConfig();
        $sagepayToken = new SagepayToken($sagepaySettings);
        $string = 'xyz';
        $response = $sagepayToken->remove($string);
        self::assertIsBool($response);
        self::assertFalse($response);
    }

    /*
    

    
    */
}
