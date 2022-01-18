<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_customer extends Model
{
    private $customer_id = null;
    private $first_name = null;
    private $last_name = null;
    private $phone = null;
    private $email = null;
    private $street = null;
    private $city = null;
    private $state = null;
    private $zip_code = null;

    function __construct($customer_id, $first_name, $last_name, $phone, $email, $street, $city, $state, $zip_code)
    {
        $this->customer_id = $customer_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip_code = $zip_code;
    }

    function getCustomerId()
    {
        return $this->id;
    }

    function setCustomerId($customer_id)
    {
        return $this->customer_id = $customer_id;
    }

    function getCustomerFirstName()
    {
        return $this->first_name;
    }

    function setCustomerFirstName($first_name)
    {
        return $this->first_name = $first_name;
    }

    function getCustomerLastName()
    {
        return $this->last_name;
    }

    function setCustomerLastName($last_name)
    {
        return $this->last_name = $last_name;
    }

    function getCustomerPhone()
    {
        return $this->phone;
    }

    function setCustomerPhone($phone)
    {
        return $this->phone = $phone;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        return $this->price = $price;
    }

    function getCustomerEmail()
    {
        return $this->email;
    }

    function setCustomerEmail($email)
    {
        return $this->email = $email;
    }

    function getCustomerStreet()
    {
        return $this->street;
    }

    function setCustomerStreet($street)
    {
        return $this->street = $street;
    }

    function getCustomerCity()
    {
        return $this->city;
    }

    function setCustomerCity($city)
    {
        return $this->city = $city;
    }

    function getCustomerState()
    {
        return $this->state;
    }

    function setCustomerState($state)
    {
        return $this->state = $state;
    }

    function getCustomerZipCode()
    {
        return $this->zip_code;
    }

    function setCustomerZipCode($zip_code)
    {
        return $this->zip_code = $zip_code;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'customer_id' => $this->customer_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code
        ]);
    }
}
