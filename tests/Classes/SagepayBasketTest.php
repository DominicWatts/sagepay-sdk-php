<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayBasket;
use Xigen\Library\Sagepay\Classes\SagepayItem;
use PHPUnit\Framework\TestCase;

class SagepayBasketTest extends TestCase
{
    /**
     * Get basket ID
     *
     * @return string
     */
    public function testGetId()
    {
        $basketOne = new SagepayBasket();
        self::assertIsString($basketOne->getId());

        $basketTwo = new SagepayBasket();
        $string = "xyz";
        $basketTwo->setId($string);
        self::assertNotSame($string, $basketTwo->getId());

        $basketThree = new SagepayBasket();
        $string = "123";
        $basketThree->setId($string);
        self::assertSame($string, $basketThree->getId());
    }

    /**
     * Get shipping fax number
     *
     * @return string
     */
    public function testGetShippingFaxNo()
    {
        $basket = new SagepayBasket();
        $string = "xyz";
        $basket->setShippingFaxNo($string);
        self::assertSame($string, $basket->getShippingFaxNo());
    }

    /**
     * Get the total amount of basket
     *
     * @return float
     */
    public function testGetAmount()
    {
        $basket = new SagepayBasket();
        $deliveryNet = 3.00;
        $deliveryTax = 1.00;
        $discountAmount = 1.00;
        $unitNetAmount = 1.00;
        $unitTaxAmount = 0.20;
        $quantity = 2;
        // items + shipping - discount
        $amount = ($quantity * ($unitNetAmount + $unitTaxAmount)) + $deliveryNet + $deliveryTax - $discountAmount;

        $item = new SagepayItem();
        $item->setQuantity($quantity);
        $item->setUnitNetAmount($unitNetAmount);
        $item->setUnitTaxAmount($unitTaxAmount);
        $basket->addItem($item);

        $basket->setDeliveryNetAmount($deliveryNet);
        $basket->setDeliveryTaxAmount($deliveryTax);
        $basket->setDiscounts([['fixed' => $discountAmount]]);
        self::assertSame($deliveryNet, $basket->getDeliveryNetAmount());
        self::assertSame($deliveryTax, $basket->getDeliveryTaxAmount());
        self::assertSame($discountAmount, $basket->getDiscountAmount());
        self::assertSame($amount, $basket->getAmount());
        self::assertIsFloat($basket->getAmount());
    }

    /**
     * Get hotel structure
     *
     * @return array
     */
    public function testGetHotel()
    {
        $basket = new SagepayBasket();
        $array = ["xyz"];
        $basket->setHotel($array);
        self::assertSame($array, $basket->getHotel());
        self::assertIsArray($basket->getHotel());
    }

    /**
     * get dinerCustomerRef
     *
     * @return string
     */
    public function testGetDinerCustomerRef()
    {
        $basket = new SagepayBasket();
        $string = "xyz";
        $basket->setDinerCustomerRef($string);
        self::assertSame($string, $basket->getDinerCustomerRef());
    }

    /**
     * Get tour operator structure
     *
     * @return array
     */
    public function testGetTourOperator()
    {
        $basket = new SagepayBasket();
        $array = ["xyz"];
        $basket->setTourOperator($array);
        self::assertSame($array, $basket->getTourOperator());
        self::assertIsArray($basket->getTourOperator());
    }

    /**
     * Get cruise structure
     *
     * @return array
     */
    public function testGetCruise()
    {
        $basket = new SagepayBasket();
        $array = ["xyz"];
        $basket->setCruise($array);
        self::assertSame($array, $basket->getCruise());
        self::assertIsArray($basket->getCruise());
    }

    /**
     * Get list of items
     *
     * @return SagepayItem[]
     */
    public function testGetItems()
    {
        $basketOne = new SagepayBasket();
        $basketOne->addItem(new SagepayItem());
        self::assertIsArray($basketOne->getItems());

        $basketTwo = new SagepayBasket();
        $basketTwo->setItems([new SagepayItem()]);
        self::assertIsArray($basketTwo->getItems());
    }

    /**
     * Get ID of the seller if using a phone payment.
     *
     * @return string
     */
    public function testGetAgentId()
    {
        $basket = new SagepayBasket();
        $string = "xyz";
        $basket->setAgentId($string);
        self::assertIsString($basket->getAgentId());
        self::assertSame($string, $basket->getAgentId());
    }

    /**
     * Get car rental structure
     *
     * @return array
     */
    public function testGetCarRental()
    {
        $basket = new SagepayBasket();
        $array = ["xyz"];
        $basket->setCarRental($array);
        self::assertSame($array, $basket->getCarRental());
        self::assertIsArray($basket->getCarRental());
    }

    /**
     * Get airline structure
     *
     * @return array
     */
    public function testGetAirline()
    {
        $basket = new SagepayBasket();
        $array = ["xyz"];
        $basket->setAirline($array);
        self::assertSame($array, $basket->getAirline());
        self::assertIsArray($basket->getAirline());
    }

    /**
     * Get shipping method
     *
     * @return string
     */
    public function testGetShippingMethod()
    {
        $basket = new SagepayBasket();
        $string = "xyz";
        $basket->setShippingMethod($string);
        self::assertSame($string, $basket->getShippingMethod());
    }

    /**
     * Get description of goods purchased is displayed on the Sage Pay Form payment page as the customer enters their card details.
     *
     * @return string
     */
    public function testGetDescription()
    {
        $basket = new SagepayBasket();
        $string = "This is a sentence that is over 100 characters long and as a result is cut by the basket logic using php substr function";
        $basket->setDescription($string);
        self::assertNotSame($string, $basket->getDescription());
        self::assertSame(100, strlen($basket->getDescription()));
    }

    /**
     * Get shipping ID
     *
     * @return string
     */
    public function testGetShipId()
    {
        $basket = new SagepayBasket();
        $string = "xyz";
        $basket->setShipId($string);
        self::assertSame($string, $basket->getShipId());
    }

    /**
     * Export Basket as XML
     *
     * @return string
     */
    public function testExportAsXML()
    {
        $basket = new SagepayBasket();
        $deliveryNet = 3.00;
        $deliveryTax = 1.00;
        $discountAmount = 1.00;
        $unitNetAmount = 1.00;
        $unitTaxAmount = 0.20;
        $quantity = 2;
        $item = new SagepayItem();
        $item->setQuantity($quantity);
        $item->setUnitNetAmount($unitNetAmount);
        $item->setUnitTaxAmount($unitTaxAmount);
        $basket->addItem($item);
        $basket->setDeliveryNetAmount($deliveryNet);
        $basket->setDeliveryTaxAmount($deliveryTax);
        $basket->setDiscounts(['fixed' => $discountAmount]);

        $testBasket = new \SimpleXMLElement('<basket></basket>');
        $item = $testBasket->addChild("item");
        $item->addChild('description');
        $item->addChild('quantity', $quantity);
        $item->addChild('unitNetAmount', $this->get2DP($unitNetAmount));
        $item->addChild('unitTaxAmount', $this->get2DP($unitTaxAmount));
        $item->addChild('unitGrossAmount', $this->get2DP($unitNetAmount + $unitTaxAmount));
        $item->addChild('totalGrossAmount', $this->get2DP($quantity * ($unitNetAmount + $unitTaxAmount)));
        $testBasket->addChild('deliveryNetAmount', $this->get2DP($deliveryNet));
        $testBasket->addChild('deliveryTaxAmount', $this->get2DP($deliveryTax));
        $testBasket->addChild('deliveryGrossAmount', $this->get2DP($deliveryNet + $deliveryTax));
        $discounts = $testBasket->addChild('discounts');
        $discounts->addChild('fixed', $this->get2DP($discountAmount));

        self::assertXmlStringEqualsXmlString($testBasket->asXML(), $basket->exportAsXml());
    }

    /**
     * Export as string with Sagepay specific format
     *
     * @return string
     */
    public function testSerialize()
    {
        $basket = new SagepayBasket();
        $deliveryNet = 3.00;
        $deliveryTax = 1.00;
        $deliveryGross = $deliveryNet + $deliveryTax;
        $basket->setDeliveryNetAmount($deliveryNet);
        $basket->setDeliveryTaxAmount($deliveryTax);
        $string = "1:Delivery:1:{$this->get2DP($deliveryNet)}:{$this->get2DP($deliveryTax)}:{$this->get2DP($deliveryGross)}:{$this->get2DP($deliveryGross)}";
        self::assertSame($string, $basket->exportAsXml(false));
        self::assertIsString($basket->exportAsXml(false));
    }

    /**
     * Format prices to 2DP
     * @param string|float $value
     * @return string
     */
    public function get2DP($value): string
    {
        return number_format($value, 2, '.', '');
    }
}
