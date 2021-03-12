<?php

namespace Classes;

use Xigen\Library\Sagepay\Classes\SagepaySettings;
use PHPUnit\Framework\TestCase;
use Xigen\Library\Sagepay\Payment;

class SagepaySettingsTest extends TestCase
{
    protected $preserveGlobalState = FALSE;
    protected $runTestInSeparateProcess = TRUE;
    protected $sagepaySettings;

    public function setUp(): void
    {
        $payment = new Payment(
            Payment::DIRECT,
            ['siteFqdns' => [
                'test' => 'https://test.com/',
                'live' => 'https://live.com/'
            ]]
        );
        $api = $payment->getApi();
        $this->sagepaySettings = $api->getConfig();
        parent::setUp();
    }

    public function tearDown(): void
    {
        $this->sagepaySettings = null;
        parent::tearDown();
    }

    /**
     * Set server profile used by default
     *
     * @param string $serverProfile  SERVER Protocol profile
     */
    public function testGetServerProfile()
    {
        $string = "LOW";
        $this->sagepaySettings->setServerProfile($string);
        self::assertSame($string, $this->sagepaySettings->getServerProfile());
    }

    public function testInvalidServerProfile()
    {
        $this->expectError();
        $string = "xyz";
        $this->sagepaySettings->setServerProfile($string);
    }

    /**
     * Get value of Allow gift aid option
     *
     * @return int  Allow gift aid option
     */
    public function testGetAllowGiftAid()
    {
        $string = "1";
        $this->sagepaySettings->setAllowGiftAid($string);
        self::assertSame($string, $this->sagepaySettings->getAllowGiftAid());
    }

    public function testInvalidAllowGiftAid()
    {
        $this->expectError();
        $string = "3";
        $this->sagepaySettings->setAllowGiftAid($string);
    }

    /**
     * Set reference to the website this transaction came from.
     *
     * @param string $website
     */
    public function testGetWebsite()
    {
        $string = "http://test.com";
        $this->sagepaySettings->setWebsite($string);
        self::assertSame($string, $this->sagepaySettings->getWebsite());
    }

    /**
     * Get value of Collect recipient details option
     *
     * @return boolean  Collect recipient details option
     */
    public function testGetCollectRecipientDetails()
    {
        $bool = true;
        $this->sagepaySettings->setCollectRecipientDetails($bool);
        self::assertSame($bool, $this->sagepaySettings->getCollectRecipientDetails());
    }

    public function testInvalidCollectRecipientDetails()
    {
        $this->expectError();
        $string = "3";
        $this->sagepaySettings->setCollectRecipientDetails($string);
    }

    /**
     * Get list of Registration Service
     *
     * @return array List of Registration Service
     */
    public function testGetPurchaseUrls()
    {
        $array['test']['form'] = 'http://test.com';
        $this->sagepaySettings->setPurchaseUrls($array);
        $urls = $this->sagepaySettings->getPurchaseUrls();
        self::assertIsArray($urls);
        self::assertSame($array['test']['form'], $urls['test']['form']);
    }

    /**
     * Get list of URL of a vendor's server
     *
     * @return array  List of siteFqdn
     */
    public function testGetSiteFqdns()
    {
        $array = ['http://test.com'];
        $this->sagepaySettings->setSiteFqdns($array);
        self::assertSame($array, $this->sagepaySettings->getSiteFqdns());
    }

    /**
     * Get value of vendor data you wish to be displayed against the transaction in MySagePay.
     *
     * @return string Vendor data
     */
    public function testGetVendorData()
    {
        $string = 'xyz';
        $this->sagepaySettings->setVendorData($string);
        self::assertSame($string, $this->sagepaySettings->getVendorData());
    }

    /**
     * Get full URL for Form Successes
     *
     * @param string $env Specific environment
     * @return string
     */
    public function testGetFullFormSuccessUrl()
    {
        $string = 'https://test.com/form/success';
        self::assertSame($string, $this->sagepaySettings->getFullFormSuccessUrl());
    }

    /**
     * Get value of Address Verification Status / Card Verification Value option
     *
     * @return int  Apply AVS/CV2 validation option
     */
    public function testGetApplyAvsCv2()
    {
        $int = 1;
        $this->sagepaySettings->setApplyAvsCv2($int);
        self::assertSame($int, $this->sagepaySettings->getApplyAvsCv2());
    }

    public function testInvalidApplyAvsCv2()
    {
        $this->expectError();
        $int = 4;
        $this->sagepaySettings->setApplyAvsCv2($int);
    }

    /**
     * Get value of Send e-mail option
     *
     * @return int  Send e-mail option
     */
    public function testGetSendEmail()
    {
        $int = 1;
        $this->sagepaySettings->setSendEmail($int);
        self::assertSame($int, $this->sagepaySettings->getSendEmail());
    }

    /**
     * Get e-mail message
     *
     * @return string  E-mail message
     */
    public function testGetEmailMessage()
    {
        $markup = '<font>xyz</font>';
        $string = 'xyz';
        $this->sagepaySettings->setEmailMessage($markup);
        self::assertIsString($this->sagepaySettings->getEmailMessage());
        self::assertIsString($string, $this->sagepaySettings->getEmailMessage());
    }

    /**
     * Get transaction type
     *
     * @return string Transaction type
     */
    public function testGetTxType()
    {
        $string = 'xyz';
        $this->sagepaySettings->setTxType($string);
        self::assertSame($string, $this->sagepaySettings->getTxType());
    }

    /**
     * Get value for notification url called by Sagepay System for SERVER Protocol
     *
     * @return string  SERVER Protocol Notification URL
     */
    public function testGetFullServerNotificationUrl()
    {
        $string = 'https://test.com/';
        self::assertSame($string, $this->sagepaySettings->getFullServerNotificationUrl());
    }

    /**
     * Get list of FORM Protocol encryption password setting
     * AES encryption password assigned to you by Sage Pay
     *
     * @return array  list of FORM Protocol encryption password
     */
    public function testGetFormPassword()
    {
        $string = 'xyz';
        $this->sagepaySettings->setFormPassword($string);
        self::assertSame($string, $this->sagepaySettings->getFormPassword());
    }

    /**
     * Get value of specific Registration Service
     *
     * @param  string  $method  Method alias
     * @param  string  $env     Environment name, by default is using current environment value
     *
     * @return string Registration Service URL
     */
    public function testGetPurchaseUrl()
    {
        $string = 'https://live.sagepay.com/gateway/service/vspserver-register.vsp';
        self::assertSame($string, $this->sagepaySettings->getPurchaseUrl('server', 'live'));
    }

    public function testGetCurrency()
    {
        $string = 'xyz';
        $this->sagepaySettings->setCurrency($string);
        self::assertSame($string, $this->sagepaySettings->getCurrency());
    }

    /**
     * Get language value ISO 639-1 valid
     *
     * @return string
     */
    public function testGetLanguage()
    {
        $locale = 'en_GB';
        $language = "en";
        $this->sagepaySettings->setLanguage($locale);
        self::assertSame($language, $this->sagepaySettings->getLanguage());
    }

    /**
     * Get value of specific method of Shared Services
     *
     * @param  string  $method  Method alias
     * @param  string  $env     Environment name, by default is using current environment value
     *
     * @return string Shared Service URL
     */
    public function testGetSharedUrl()
    {
        $url = 'https://test.com';
        $this->sagepaySettings->setSharedUrl($url, 'server', 'live');
        self::assertSame($url, $this->sagepaySettings->getSharedUrl('server', 'live'));
    }

    /**
     * Get password salt for the local customer password database used by the kit
     *
     * @return string  Password salt
     */
    public function testGetCustomerPasswordSalt()
    {
        $string = "123456789";
        $this->sagepaySettings->setCustomerPasswordSalt($string);
        self::assertNotSame($string, $this->sagepaySettings->getCustomerPasswordSalt());
    }

    /**
     * Set value of vendor email
     *
     * @param string $vendorEmail Vendor email
     */
    public function testGetVendorEmail()
    {
        $string = 'test@test.com';
        $this->sagepaySettings->setVendorEmail($string);
        self::assertSame($string, $this->sagepaySettings->getVendorEmail());
    }

    public function testInvalidVendorEmail()
    {
        $this->expectError();
        $string = 'test.com';
        $this->sagepaySettings->setVendorEmail($string);
    }

    /**
     * Get Log Error option
     *
     * @return boolean
     */
    public function testGetLogError()
    {
        $bool = true;
        $this->sagepaySettings->setLogError($bool);
        self::assertSame($bool, $this->sagepaySettings->getLogError());
    }

    /**
     * Get value of Billing Agreement option
     *
     * @return int  Billing Agreement option
     */
    public function testGetBillingAgreement()
    {
        $int = 1;
        $this->sagepaySettings->setBillingAgreement($int);
        self::assertSame($int, $this->sagepaySettings->getBillingAgreement());
    }

    public function testInvalidBillingAgreement()
    {
        $this->expectError();
        $int = 2;
        $this->sagepaySettings->setBillingAgreement($int);
    }

    /**
     * Get list of Token Services
     *
     * @return array  List of Token Services
     */
    public function testGetTokenUrls()
    {
        $string = 'https://test.sagepay.com/gateway/service/token.vsp';
        $urls = $this->sagepaySettings->getTokenUrls();
        self::assertSame($string, $urls['test']['register-server']);
    }

    /**
     * Get value of 3D Secure Verification option
     *
     * @return int  3D Secure Verification option
     */
    public function testGetApply3dSecure()
    {
        $int = 1;
        $this->sagepaySettings->setApply3dSecure($int);
        self::assertSame($int, $this->sagepaySettings->getApply3dSecure());
    }

    public function testInvalidApply3dSecure()
    {
        $this->expectError();
        $int = 4;
        $this->sagepaySettings->setApply3dSecure($int);
    }

    /**
     * Get value for notification url called by Sagepay System for SERVER Protocol
     *
     * @return string  SERVER Protocol Notification URL
     */
    public function testGetServerNotificationUrl()
    {
        $string = 'test@test.com';
        $this->sagepaySettings->setserverNotificationUrl($string);
        self::assertSame($string, $this->sagepaySettings->getServerNotificationUrl());
    }

    /**
     * Get url for specific token service and environment
     *
     * @param  string  $method  Method name
     * @param  string  $env     Environment name, by default is using current environment value
     *
     * @return string  Token Service URL
     */
    public function testGetTokenUrl()
    {
        $string = 'https://token.url';
        $this->sagepaySettings->setTokenUrl($string, 'server', 'live');
        self::assertSame($string, $this->sagepaySettings->getTokenUrl('server', 'live'));
    }

    /**
     * Get vendor name provided by Sagepay service
     *
     * @return string  Vendor name
     */
    public function testGetVendorName()
    {
        $string = 'test';
        $this->sagepaySettings->setVendorName($string);
        self::assertSame($string, $this->sagepaySettings->getVendorName());
    }

    /**
     * Get value of Basket as XML seeting
     *
     * @return boolean  Basket as XML
     */
    public function testBasketAsXmlDisabled()
    {
        $bool = true;
        $this->sagepaySettings->setBasketAsXmlDisable($bool);
        self::assertSame($bool, $this->sagepaySettings->basketAsXmlDisabled());
    }

    public function testInvalidBasketAsXmlDisabled()
    {
        $this->expectError();
        $string = "123";
        $this->sagepaySettings->setBasketAsXmlDisable($string);
    }

    /**
     * Get merchant account type
     *
     * @return string
     */
    public function testGetAccountType()
    {
        $string = 'E';
        $this->sagepaySettings->setAccountType($string);
        self::assertSame($string, $this->sagepaySettings->getAccountType());
    }

    public function testInvalidAccountType()
    {
        $this->expectError();
        $string = 'xyz';
        $this->sagepaySettings->setAccountType($string);
    }


    /**
     * Get value of PayPal Callback URL
     *
     * @return string PayPal Callback URL
     */
    public function testGetPaypalCallbackUrl()
    {
        $string = 'test';
        $this->sagepaySettings->setPaypalCallbackUrl($string);
        self::assertSame($string, $this->sagepaySettings->getPaypalCallbackUrl());
    }

    /**
     * Get full URL for Form Failures
     *
     * @param string $env Specific environment
     * @return string
     */
    public function testGetFormFailureUrl()
    {
        $string = 'form/failure';
        self::assertSame($string, $this->sagepaySettings->getFormFailureUrl());
    }

    /**
     * Get environment.
     *
     * @return string  Environment
     */
    public function testGetEnv()
    {
        $string = 'test';
        $this->sagepaySettings->setEnv($string);
        self::assertSame($string, $this->sagepaySettings->getEnv());
    }

    public function testInvalidEnv()
    {
        $this->expectError();
        $string = 'invalid';
        $this->sagepaySettings->setEnv($string);
    }

    /**
     * Get timeout for POST cURL requests
     *
     * @return int
     */
    public function testGetRequestTimeout()
    {
        $int = 1;
        $this->sagepaySettings->setRequestTimeout($int);
        self::assertSame($int, $this->sagepaySettings->getRequestTimeout());
    }

    public function testInvalidRequestTimeout()
    {
        $this->expectError();
        $string = "xyz";
        $this->sagepaySettings->setRequestTimeout($string);
    }

    /**
     * Get list of Shared Services
     *
     * @return array  List of Shared Services
     */
    public function testGetSharedUrls()
    {
        $url = 'https://test.com';
        $this->sagepaySettings->setSharedUrl($url, 'server', 'live');
        $array = $this->sagepaySettings->getSharedUrls();
        self::assertSame($url, $array['live']['server']);
    }

    /**
     * Get success page redirect for FORM Protocol
     *
     * @return string  FORM Protocol success URL
     */
    public function testGetFormSuccessUrl()
    {
        $string = 'form/success';
        self::assertSame($string, $this->sagepaySettings->getFormSuccessUrl());
    }

    /**
     * Get List of Surcharges
     *
     * @return array  list of Surcharges
     */
    public function testGetSurcharges()
    {
        $array = ['test'];
        $this->sagepaySettings->setSurcharges($array);
        self::assertSame($array, $this->sagepaySettings->getSurcharges());
    }

    /**
     * Get CACert file path
     *
     * @return string
     */
    public function testGetCaCertPath()
    {
        $string = 'test';
        $this->sagepaySettings->setCaCertPath($string);
        self::assertSame($string, $this->sagepaySettings->getCaCertPath());
    }

    /**
     * Get unique partner ID
     *
     * @return string  Partner ID
     */
    public function testGetPartnerId()
    {
        $string = 'test';
        $this->sagepaySettings->setPartnerId($string);
        self::assertSame($string, $this->sagepaySettings->getPartnerId());
    }

    public function testGetInstance()
    {
        $setting = $this->sagepaySettings->getInstance(['vendor']);
        self::assertIsObject($setting);
    }

    /**
     * Get SagePay Protocol Version used for payment
     *
     * @return float  Protocol version
     */
    public function testGetProtocolVersion()
    {
        $float = 3.00;
        $string = number_format($float, 2);
        $this->sagepaySettings->setProtocolVersion($float);
        self::assertSame($string, $this->sagepaySettings->getProtocolVersion());
        self::assertIsString($this->sagepaySettings->getProtocolVersion());
    }

    public function testInvalidProtocolVersion()
    {
        $this->expectError();
        $int = 3;
        $this->sagepaySettings->setProtocolVersion($int);
    }
}
