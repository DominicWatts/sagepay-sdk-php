# sagepay-sdk-php

![phpcs](https://github.com/DominicWatts/sagepay-sdk-php/workflows/phpcs/badge.svg)

![PHPCompatibility](https://github.com/DominicWatts/sagepay-sdk-php/workflows/PHPCompatibility/badge.svg)

![PHPStan](https://github.com/DominicWatts/sagepay-sdk-php/workflows/PHPStan/badge.svg)

[![Coverage Status](https://coveralls.io/repos/github/DominicWatts/sagepay-sdk-php/badge.svg)](https://coveralls.io/github/DominicWatts/sagepay-sdk-php)

[Coveralls Status](https://coveralls.io/github/DominicWatts/sagepay-sdk-php)

Sage Pay PHP SDK for server, frame and direct integrations based on the official Sage Pay SDK. This is a composer compatible Sage Pay V3 PHP SDK. This is not an official Sage Pay package.

## Install Instructions

`composer require dominicwatts/sagepay-sdk-php`

There is a composer archive at:

    https://packagist.org/packages/dominicwatts/sagepay-sdk-php

## Usage

```
require 'vendor/autoload.php';

use Xigen\Library\Sagepay\Payment;
use Xigen\Library\Sagepay\Classes\SagepayCustomer;
use Xigen\Library\Sagepay\Classes\SagepayCustomerDetails;

$config = [
    'vendorName' => 'testing'
];

$payment = new Payment(
    Payment::FORM,
    $config
);

$customer = new SagepayCustomer();
$customerDetails = new SagepayCustomerDetails();
$customerDetails->__set('firstname', 'Dave');
$customerDetails->setLastname('Smith');

$api = $payment->getApi();

$api->setCustomer($customer);
$api->setCustomerDetails($customerDetails);

var_dump($api);

$api->createRequest();
```

## Copyright

The original SDK belongs to SagePay and is their intellectual property. No license information is available but this is based on their publicly accessible source code.
