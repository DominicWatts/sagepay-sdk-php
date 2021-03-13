<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepaySurcharge;
use PHPUnit\Framework\TestCase;

class SagepaySurchargeTest extends TestCase
{
    public $sagepaySurcharge = null;

    public function setUp(): void
    {
        $this->sagepaySurcharge = new SagepaySurcharge();
        parent::setUp();
    }

    public function tearDown(): void
    {
        $this->sagepaySurcharge = null;
        parent::tearDown();
    }

    public function testAddSurchargeDetails()
    {
        $this->sagepaySurcharge->addSurchargeDetails('visa', '10');
        $result = $this->sagepaySurcharge->getSurcharges();
        self::assertIsArray($result);
        self::assertNotEmpty($result);
    }

    public function testInvalidAddSurchargeDetails()
    {
        $this->sagepaySurcharge->addSurchargeDetails('invalid', '10', '10');
        $result = $this->sagepaySurcharge->getSurcharges();
        self::assertIsArray($result);
        self::assertEmpty($result);
    }

    /**
     * Get surcharges
     *
     * @return array
     */
    public function testGetSurcharges()
    {
        $array = ['test'];
        $this->sagepaySurcharge->setSurcharges($array);
        $result = $this->sagepaySurcharge->getSurcharges();
        self::assertIsArray($result);
        self::assertNotEmpty($result);
    }

    /**
     * Export surcharges details as XML string
     *
     * @return string XML with surcharges details
     */
    public function testExport()
    {
        $paymentType = 'visa';
        $percentage = 10;
        $this->sagepaySurcharge->addSurchargeDetails($paymentType, $percentage);

        $testSurcharge = new \SimpleXMLElement('<surcharges></surcharges>');
        $surcharge = $testSurcharge->addChild("surcharge");
        $surcharge->addChild('paymentType', $paymentType);
        $surcharge->addChild('percentage', $percentage);
        self::assertXmlStringEqualsXmlString($testSurcharge->asXML(), $this->sagepaySurcharge->export());
    }

}
