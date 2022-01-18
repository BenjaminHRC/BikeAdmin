<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_store extends Model
{
    private $store_id = null;
    private $store_name = null;
    private $phone = null;
    private $email = null;
    private $street = null;
    private $city = null;
    private $state = null;
    private $zip_code = null;

    function __construct($store_id, $store_name, $phone, $email, $street, $city, $state, $zip_code)
    {
        $this->store_id = $store_id;
        $this->store_name = $store_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip_code = $zip_code;
    }

    function getStoreId()
    {
        return $this->store_id;
    }

    function setStoreId($store_id)
    {
        return $this->store_id = $store_id;
    }

    function getStoreName()
    {
        return $this->store_name;
    }

    function setStoreName($store_name)
    {
        return $this->store_name = $store_name;
    }

    function getStorePhone()
    {
        return $this->phone;
    }

    function setStorePhone($phone)
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

    function getStoreEmail()
    {
        return $this->email;
    }

    function setStoreEmail($email)
    {
        return $this->email = $email;
    }

    function getStoreStreet()
    {
        return $this->street;
    }

    function setStoreStreet($street)
    {
        return $this->street = $street;
    }

    function getStoreCity()
    {
        return $this->city;
    }

    function setStoreCity($city)
    {
        return $this->city = $city;
    }

    function getStoreState()
    {
        return $this->state;
    }

    function setStoreState($state)
    {
        return $this->state = $state;
    }

    function getStoreZipCode()
    {
        return $this->zip_code;
    }

    function setStoreZipCode($zip_code)
    {
        return $this->zip_code = $zip_code;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'store_id' => $this->store_id,
            'store_name' => $this->store_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code
        ]);
    }
}
