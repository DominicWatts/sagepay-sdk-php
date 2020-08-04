<?php

namespace Xigen\Library\Sagepay\Classes;

/**
 * The card details used for payment process
 *
 * @category  Payment
 * @copyright (c) 2013, Sage Pay Europe Ltd.
 */
class SagepayCardDetails
{

    /**
     * The card type
     *
     * @var string
     */
    private $_cardType;

    /**
     * The card number
     *
     * @var string
     */
    private $_cardNumber;

    /**
     * The Cardholder Name as it appears on the card
     *
     * @var string
     */
    private $_cardHolder;

    /**
     * The start date of card
     *
     * @var string
     */
    private $_startDate;

    /**
     * The ecpiry date of card
     *
     * @var string
     */
    private $_expiryDate;

    /**
     * The Card Verification Value
     *
     * @var string
     */
    private $_cv2;

    /**
     * Allows the gift aid acceptance box to appear for this transaction on the payment page
     *
     * @var string
     */
    private $_giftAid;

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'cardNumber' => [
            ['notEmpty'],
            ['creditCard'],
        ],
        'cardHolder' => [
            ['notEmpty'],
            ['maxLength', [20]],
            ['regex', ["/^[a-zA-Z\xC0-\xFF0-9\s\\\\\/&\.\']*$/"]],
        ],
        'startDate' => [
            ['regex', ["/^([0-9]{4})*$/"]],
        ],
        'expiryDate' => [
            ['notEmpty'],
            ['regex', ["/^([0-9]{4})*$/"]],
        ],
        'cv2' => [
            ['notEmpty'],
        ],
    ];

    /**
     * Reading data from inaccessible properties.
     *
     * @param string $name
     * @return string
     */
    public function __get($name)
    {
        $privateName = "_" . $name;
        if (property_exists($this, $privateName)) {
            return $this->$privateName;
        }
        return null;
    }

    /**
     * Writing data to inaccessible properties
     *
     * @param string $name
     * @param string $value
     */
    public function __set($name, $value)
    {
        $privateName = "_" . $name;
        if (property_exists($this, $privateName)) {
            $this->$privateName = $value;
        }
    }

    /**
     * Validates values using validation rules and return the result
     *
     * @return array
     */
    public function validate()
    {
        if ($this->cardType == 'AMEX') {
            $this->rules['cv2'][] = ['exactLength', [3, 4]];
        } else {
            $this->rules['cv2'][] = ['exactLength', [3]];
        }

        $errors = [];
        foreach ($this->rules as $key => $rule) {
            $propertyValue = $this->$key;
            $validator = new SagepayValidator($propertyValue, $rule);
            if (!$validator->isValid()) {
                $errors[$key] = $validator->getErrors();
            }
        }
        return $errors;
    }

    /**
     * Get Card type
     * @return string
     */
    public function getCardType()
    {
        return $this->_cardType;
    }
    
    /**
     * Set Card type
     * @param string $cardType
     */
    public function setCardType($cardType)
    {
        $this->_cardType = $cardType;
    }

    /**
     * Get Card type
     * @return string
     */
    public function getCardNumber()
    {
        return $this->_cardNumber;
    }
      
    /**
     * Set Card number
     * @param string $cardNumber
     */
    public function setCardNumber($cardNumber)
    {
        $this->_cardNumber = $cardNumber;
    }
      
    /**
     * Get Card holder
     * @return string
     */
    public function getCardHolder()
    {
        return $this->_cardHolder;
    }
      
    /**
     * Set Card holder
     * @param string $cardHolder
     */
    public function setCardHolder($cardHolder)
    {
        $this->_cardHolder = $cardHolder;
    }
    
    /**
     * Get Card start
     * @return string
     */
    public function getStartDate()
    {
        return $this->_startDate;
    }
     
    /**
     * Set Card start
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
    }

    /**
     * Get Card expiry
     * @return string
     */
    public function getExpiryDate()
    {
        return $this->_expiryDate;
    }
      
    /**
     * Set Card expiry
     * @param string $expiryDate
     */
    public function setExpiryDate($expiryDate)
    {
        $this->_expiryDate = $expiryDate;
    }
      
    /**
     * Get Card cv2
     * @return string
     */
    public function getCv2()
    {
        return $this->_cv2;
    }
      
    /**
     * Set Card cv2
     * @param string $cv2
     */
    public function setCv2($cv2)
    {
        $this->_cv2 = $cv2;
    }
      
    /**
     * Get gift aid
     * @return string
     */
    public function getGiftAid()
    {
        return $this->_giftAid;
    }
      
    /**
     * Set Card giftAid
     * @param string $giftAid
     */
    public function setGiftAid($giftAid)
    {
        $this->_giftAid = $giftAid;
    }
}
