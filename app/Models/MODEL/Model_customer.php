<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_customer extends Model
{
    function createIt($customer)
    {
        try {
            DB::insert(
                'INSERT INTO sales.customers (first_name, last_name, phone, email, street, city, state, zip_code) values (?, ?, ?, ?, ?, ?, ?, ?)',
                [
                    $customer->getCustomerFirstName(),
                    $customer->getCustomerLastName(),
                    $customer->getCustomerPhone(),
                    $customer->getCustomerEmail(),
                    $customer->getCustomerStreet(),
                    $customer->getCustomerCity(),
                    $customer->getCustomerState(),
                    $customer->getCustomerZipCode()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($customer)
    {
        try {
            DB::update(
                'UPDATE sales.customers set first_name = ?, last_name = ?, phone = ?, email = ?, street = ?, city = ?, state = ?, zip_code = ? WHERE customer_id = ?',
                [
                    $customer->getCustomerFirstName(),
                    $customer->getCustomerLastName(),
                    $customer->getCustomerPhone(),
                    $customer->getCustomerEmail(),
                    $customer->getCustomerStreet(),
                    $customer->getCustomerCity(),
                    $customer->getCustomerState(),
                    $customer->getCustomerZipCode(),
                    $customer->getCustomerId()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function findAll()
    {
        $query = DB::select(
            'SELECT customer_id, first_name, last_name, phone, email, street, city, state, zip_code FROM sales.customers',
        );

        $results = [];

        foreach ($query as $value) {
            $customer = new Dao_customer(
                $value->customer_id,
                $value->first_name,
                $value->last_name,
                $value->phone,
                $value->email,
                $value->street,
                $value->city,
                $value->state,
                $value->zip_code
            );
            array_push($results, $customer);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $result = DB::select(
                'SELECT customer_id, first_name, last_name, phone, email, street, city, state, zip_code FROM sales.customers WHERE customer_id = ?',
                [$id]
            );
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function dropIt($id)
    {
        try {
            DB::delete(
                'DELETE FROM sales.customers WHERE customer_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}