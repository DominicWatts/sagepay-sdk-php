<?php

namespace Xigen\Library\Sagepay\Classes;

use Xigen\Library\Sagepay\Payment;
use PHPUnit\Framework\TestCase;

class SagepayApiFactoryTest extends TestCase
{

    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

    /**
     * Create instance of required integration type
     * Switching to namespaces broke autoloading
     *
     * @param string           $type    Integration type
     * @param SagepaySettings  $config  Sagepay config instance
     *
     * @return SagepayAbstractApi
     */
    public function testCreate()
    {
        $payment = new Payment(Payment::FORM);
        $class = SagepayApiFactory::create(
            Payment::FORM,
            new SagepaySettings(['test' => 'value'])
        );
        self::assertIsObject($class);
        self::assertInstanceOf(SagepayFormApi::class, $class);
    }

    public function testDirect()
    {
        $payment = new Payment(Payment::DIRECT);
        $class = SagepayApiFactory::create(
            Payment::DIRECT,
            new SagepaySettings(['test' => 'value'])
        );
        self::assertIsObject($class);
        self::assertInstanceOf(SagepayDirectApi::class, $class);
    }

    public function testServer()
    {
        $payment = new Payment(Payment::SERVER);
        $class = SagepayApiFactory::create(
            Payment::SERVER,
            new SagepaySettings(['test' => 'value'])
        );
        self::assertIsObject($class);
        self::assertInstanceOf(SagepayServerApi::class, $class);
    }
}
