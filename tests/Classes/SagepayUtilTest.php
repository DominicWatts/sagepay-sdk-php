<?php

namespace Classes;

use Xigen\Library\Sagepay\Payment;
use Xigen\Library\Sagepay\Classes\SagepayApiException;
use Xigen\Library\Sagepay\Classes\SagepayUtil;
use PHPUnit\Framework\TestCase;

class SagepayUtilTest extends TestCase
{
    /**
     * Populate the card names in to a usable array.
     *
     * @param array $availableCards Available card codes.
     *
     * @return array Array of card codes and names.
     */
    public function testAvailableCards()
    {
        $cards = SagepayUtil::availableCards([
            'visa',
            'mastercard',
            'invalid'
        ]);

        self::assertIsArray($cards);
        self::assertCount(2, $cards);
    }

    public function testInvalidDecryptAes()
    {
        $this->expectException(SagepayApiException::class);
        $result = SagepayUtil::decryptAes('string', 'password');
    }

    public function testGetLast4Digits()
    {
        $cardNumber = '4929000000006';
        $last4 = '0006';
        $result = SagepayUtil::getLast4Digits($cardNumber);
        self::assertIsString($result);
        self::assertSame($last4, $result);
    }
}
