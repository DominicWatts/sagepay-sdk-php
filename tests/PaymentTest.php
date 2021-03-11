<?php

use Xigen\Library\Sagepay\Payment;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * API getter and setter
     */
    public function testGetApi()
    {
        $payment = new Payment(Payment::FORM);
        $api = new \stdClass();
        $payment->setApi($api);
        self::assertSame($api, $payment->getApi());
    }

    public function testInvalidPaymentType()
    {
        $this->expectException(\Exception::class);
        $payment = new Payment();
    }
}
