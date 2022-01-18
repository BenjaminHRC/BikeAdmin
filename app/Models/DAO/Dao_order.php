<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_order extends Model
{
    private $order_id = null;
    private $order_status = null;
    private $order_date = null;
    private $required_date = null;
    private $shipped_date = null;
    private $customer_id = null;
    private $store_id = null;
    private $staff_id = null;
    private $customer = null;
    private $store = null;
    private $staff = null;

    function __construct($order_id, $order_status, $order_date, $required_date, $shipped_date, $customer_id, $store_id, $staff_id)
    {
        $this->order_id = $order_id;
        $this->order_status = $order_status;
        $this->order_date = $order_date;
        $this->required_date = $required_date;
        $this->shipped_date = $shipped_date;
        $this->customer_id = $customer_id;
        $this->store_id = $store_id;
        $this->staff_id = $staff_id;
        $this->customer = null;
        $this->store = null;
        $this->staff = null;
    }

    function getOrderId()
    {
        return $this->order_id;
    }

    function setOrderId($order_id)
    {
        return $this->order_id = $order_id;
    }

    function getOrderStatus()
    {
        return $this->order_status;
    }

    function setOrderStatus($order_status)
    {
        return $this->order_status = $order_status;
    }

    function getOrderDate()
    {
        return $this->order_date;
    }

    function setOrderDate($order_date)
    {
        return $this->order_date = $order_date;
    }

    function getRequiredDate()
    {
        return $this->required_date;
    }

    function setRequiredDate($required_date)
    {
        return $this->required_date = $required_date;
    }

    function getShippedDate()
    {
        return $this->shipped_date;
    }

    function setShippedDate($shipped_date)
    {
        return $this->shipped_date = $shipped_date;
    }

    function getCustomerId()
    {
        return $this->customer_id;
    }

    function setCustomerId($customer_id)
    {
        return $this->customer_id = $customer_id;
    }

    function getStoreId()
    {
        return $this->store_id;
    }

    function setStoreId($store_id)
    {
        return $this->store_id = $store_id;
    }

    function getStaffId()
    {
        return $this->staff_id;
    }

    function setStaffId($staff_id)
    {
        return $this->staff_id = $staff_id;
    }

    function getCustomer()
    {
        return $this->customer;
    }

    function setCustomer($customer)
    {
        //var_dump($customer);
        return $this->customer = $customer;
    }

    function getStore()
    {
        return $this->store;
    }

    function setStore($store)
    {
        //var_dump($customer);
        return $this->store = $store;
    }

    function getStaff()
    {
        return $this->staff;
    }

    function setStaff($staff)
    {
        //var_dump($customer);
        return $this->staff = $staff;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'order_id' => $this->order_id,
            'order_status' => $this->order_status,
            'order_date' => $this->order_date,
            'required_date' => $this->required_date,
            'shipped_date' => $this->shipped_date,
            'customer_id' => $this->customer_id,
            'store_id' => $this->store_id,
            'staff_id' => $this->staff_id,
            'customer' => json_decode($this->customer->toJSONPrivate()),
            'store' => json_decode($this->store->toJSONPrivate()),
            'staff' => json_decode($this->staff->toJSONPrivate()),
        ]);
    }
}
