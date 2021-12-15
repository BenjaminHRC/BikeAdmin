<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_staff extends Model
{
    private $id = null;
    private $first_name = null;
    private $last_name = null;
    private $email = null;
    private $phone = null;
    private $active = null;
    private $store_id = null;
    private $manager_id = null;

    function __construct($id, $first_name, $last_name, $email, $phone, $active, $store_id, $manager_id)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->active = $active;
        $this->store_id = $store_id;
        $this->manager_id = $manager_id;
    }

    function getStaffId()
    {
        return $this->id;
    }

    function setStaffId($id)
    {
        return $this->id = $id;
    }

    function getStaffFirstName()
    {
        return $this->first_name;
    }

    function setStaffFirstName($first_name)
    {
        return $this->first_name = $first_name;
    }

    function getStaffLastName()
    {
        return $this->last_name;
    }

    function setStaffLastName($last_name)
    {
        return $this->last_name = $last_name;
    }

    function getStaffEmail()
    {
        return $this->email;
    }

    function setStaffEmail($email)
    {
        return $this->email = $email;
    }

    function getStaffPhone()
    {
        return $this->phone;
    }

    function setStaffPhone($phone)
    {
        return $this->phone = $phone;
    }

    function getStaffActive()
    {
        return $this->active;
    }

    function setStaffState($active)
    {
        return $this->active = $active;
    }

    function getStaffStoreId()
    {
        return $this->store_id;
    }

    function setStaffStoreId($store_id)
    {
        return $this->store_id = $store_id;
    }

    function getStaffManagerId()
    {
        return $this->manager_id;
    }

    function setStaffManagerId($manager_id)
    {
        return $this->manager_id = $manager_id;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'active' => $this->active,
            'store_id' => $this->store_id,
            'manager_id' => $this->manager_id
        ]);
    }
}