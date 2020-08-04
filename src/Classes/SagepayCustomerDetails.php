<?php

namespace Xigen\Library\Sagepay\Classes;

/**
 * The customer details used for payment process
 *
 * @category  Payment
 * @copyright (c) 2013, Sage Pay Europe Ltd.
 */
class SagepayCustomerDetails
{

    /**
     * The first name of the customer
     *
     * @var string
     */
    private $_firstname = '';

    /**
     * The last name of the customer
     *
     * @var string
     */
    private $_lastname = '';

    /**
     * The first address of the customer
     *
     * @var string
     */
    private $_address1 = '';

    /**
     * The second address of the customer
     *
     * @var string
     */
    private $_address2 = '';

    /**
     * The email of the customer
     *
     * @var string
     */
    private $_email = '';

    /**
     * The phone number of the customer
     *
     * @var string
     */
    private $_phone = '';

    /**
     * The city of the customer
     *
     * @var string
     */
    private $_city = '';

    /**
     * The postcode of the customer
     *
     * @var string
     */
    private $_postcode = '';

    /**
     * The country of the customer
     *
     * @var string
     */
    private $_country = '';

    /**
     * The state of the customer
     *
     * @var string
     */
    private $_state = '';

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules = [
        'firstname' => [
            ['notEmpty'],
            ['maxLength', [20]],
            ['regex', ["/^[a-zA-Z\xC0-\xFF0-9\s\\\\\/&\.\']*$/"]],
        ],
        'lastname' => [
            ['notEmpty'],
            ['maxLength', [20]],
            ['regex', ["/^[a-zA-Z\xC0-\xFF0-9\s\\\\\/&\.\']*$/"]],
        ],
        'address1' => [
            ['notEmpty'],
            ['maxLength', [100]],
            ['regex', ["/^[a-zA-Z\xC0-\xFF0-9\s\+\'\\\\\/&:,\.\-()]*$/"]],
        ],
        'address2' => [
            ['maxLength', [100]],
            ['regex', ["/^[a-zA-Z\xC0-\xFF0-9\s\+\'\\\\\/&:,\.\-()]*$/"]],
        ],
        'email' => [
            ['maxLength', [255]],
            ['email'],
        ],
        'phone' => [
            ['maxLength', [20]],
            ['regex', ["/^[0-9\-a-zA-Z+\s()]*$/"]],
        ],
        'city' => [
            ['notEmpty'],
            ['maxLength', [40]],
            ['regex', ["/^[a-zA-Z\xC0-\xFF0-9\s\+\'\\\\\/&:,\.\-()]*$/"]],
        ],
        'postcode' => [
            ['maxLength', [10]],
            ['regex', ["/^[a-zA-Z0-9\s-]*$/"]],
        ],
        'country' => [
            ['notEmpty'],
            ['maxLength', [2]],
            ['regex', ["/^[A-Z]{2}$/"]],
        ],
        'state' => [
            ['maxLength', [2]],
            ['regex', ["/^([A-Z]{2})*$/"]],
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
     * Constructor for SagepayCustomerDetails
     */
    public function __construct()
    {
        $this->rules['state'][] = [[$this, 'validUsa']];
        $this->rules['postcode'][] = [[$this, 'notEmptyZipCodeUK']];
    }

    /**
     * Get default postcode if the address supplied didn't have one
     *
     * @param string $default   The default value to use when not found or empty
     *
     * @return string
     */
    public function getPostCode($default = '')
    {
        if (empty($this->_postcode)) {
            $this->_postcode = $default;
        }
        return $this->_postcode;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->_postcode = $postcode;
    }

    /**
     * Validates values using validation rules and return the result
     *
     * @return string[]
     */
    public function validate()
    {
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
     * Validate State Code for US only
     * Validate State Code for other country not US
     *
     * @param string $value
     *
     * @return boolean
     */
    public function validUsa($value)
    {
        if ($this->_country == 'US') {
            return SagepayValid::notEmpty($value);
        } else {
            return SagepayValid::equals($value, "");
        }
    }

    /**
     * Validate Zip Code for UK only
     *
     * @param string $value
     *
     * @return boolean
     */
    public function notEmptyZipCodeUK($value)
    {
        if ($this->_country == 'GB') {
            return SagepayValid::notEmpty($value);
        }
        return true;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->_firstname = $firstname;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->_lastname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->_lastname = $lastname;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->_address1;
    }

    /**
     * Set address1
     *
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->_address1 = $address1;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->_address2;
    }

    /**
     * Set address2
     *
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->_address2 = $address2;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * Get country
     *
     * @param string $country
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->_country = $country;
    }

    /**
     * Get state
     *
     * @param string $state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setState($state)
    {
        $this->_state = $state;
    }
}
