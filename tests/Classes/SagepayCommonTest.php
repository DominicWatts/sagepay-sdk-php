<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepayBasket;
use Xigen\Library\Sagepay\Classes\SagepayCommon;
use Xigen\Library\Sagepay\Classes\SagepayCustomer;
use Xigen\Library\Sagepay\Classes\SagepayCustomerDetails;
use Xigen\Library\Sagepay\Classes\SagepayItem;

use Xigen\Library\Sagepay\Payment;
use PHPUnit\Framework\TestCase;

class SagepayCommonTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;

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

    /**
     * Generate values for payment.
     * Ensure that post data is setted to request with SagepayAbstractApi::setData()
     *
     * @return array The response from Sage Pay
     */
    public function testFormCreateRequest()
    {
        $this->expectError();
        $this->initialiseConfig();

        $this->payment = new Payment(
            Payment::FORM,
            $this->config
        );

        $this->api = $this->payment->getApi();

        $this->setCustomer();
        $this->setCustomerDetails();
        $this->setBasket();

        $sagepayParams = $this->api->createRequest();

        self::assertIsArray($sagepayParams);
    }

    /**
     * Generate values for payment.
     * Ensure that post data is setted to request with SagepayAbstractApi::setData()
     *
     * @return array The response from Sage Pay
     */
    public function testServerCreateRequest()
    {
        $this->initialiseConfig();

        $this->payment = new Payment(
            Payment::SERVER,
            $this->config
        );

        $this->api = $this->payment->getApi();

        $this->setCustomer();
        $this->setCustomerDetails();
        $this->setBasket();

        $this->api->setPaneValues(['cardType' => 'visa']);

        $sagepayParams = $this->api->createRequest();

        self::assertIsArray($sagepayParams);
    }

    /**
     * Generate values for payment.
     * Ensure that post data is setted to request with SagepayAbstractApi::setData()
     *
     * @return array The response from Sage Pay
     */
    public function testDirectCreateRequest()
    {
        // $this->expectError();
        $this->initialiseConfig();

        $this->payment = new Payment(
            Payment::DIRECT,
            $this->config
        );

        $this->api = $this->payment->getApi();

        $this->setCustomer();
        $this->setCustomerDetails();
        $this->setBasket();

        $this->api->setPaneValues([
            'cardType' => 'visa',
            'cardNumber' => '4929000000006',
            'expiryDate' => '2227'
        ]);

        $sagepayParams = $this->api->createRequest();

        self::assertIsArray($sagepayParams);
    }

    /**
     * Set addressList
     *
     * @param SagepayCustomerDetails[] $addressList
     */
    public function testAddressList()
    {
        $this->initialiseConfig();

        $this->payment = new Payment(
            Payment::SERVER,
            $this->config
        );

        $this->api = $this->payment->getApi();

        $this->setCustomerDetails();

        $addressList = $this->api->getAddressList();
        unset($addressList[0]);
        $this->api->setAddressList($addressList);

        $updatedAddressList = $this->api->getAddressList();
        self::assertIsArray($updatedAddressList);
        self::assertCount(1, $updatedAddressList);
    }

    /***
     * Load configs
     * @return void
     */
    protected function initialiseConfig()
    {
        $this->config = [
            'vendorName' => 'test',
            'env' => 'test',
            'txType' => 'PAYMENT',
            'siteFqdns' => [
                'test' => 'test',
                'live' => 'test',
            ],
            'formSuccessUrl' => 'success',
            'formFailureUrl' => 'failure',
            'formPassword' => [
                'test' => 'test',
                'live' => 'test',
            ],
            'website' => 'http://test.com',
        ];
    }

    /**
     * Add customer ID
     * @return void
     */
    protected function setCustomer()
    {
        $customer = new SagepayCustomer();
        $customer->setCustomerId(123);
        $this->api->setCustomer($customer);
    }

    /**
     * Add address details
     * @return void
     */
    protected function setCustomerDetails()
    {
        $customerDetails = new SagepayCustomerDetails();
        $customerDetails->setFirstname('test');
        $customerDetails->setLastname('test');
        $customerDetails->setAddress1('test');
        $customerDetails->setAddress2('test');
        $customerDetails->setCity('test');
        $customerDetails->setState('test');
        $customerDetails->setPostcode('test');
        $customerDetails->setCountry('GB');
        $customerDetails->setPhone('01234567890');
        $customerDetails->setEmail('test@test.com');
        $this->api->setCustomerDetails($customerDetails);
        // alias to above
        $this->api->addAddress($customerDetails);
    }

    /**
     * Build basket
     * @return void
     */
    protected function setBasket()
    {
        $item = new SagepayItem();
        $item->setDescription('test');
        $item->setProductSku('test');
        $item->setProductCode('test');
        $item->setQuantity(1);
        $item->setUnitNetAmount((float) 1);
        $item->setUnitTaxAmount(0);

        $basket = new SagepayBasket();
        $basket->addItem($item);
        $basket->setDescription('test');
        $this->api->setBasket($basket);
    }
}
