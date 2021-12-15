<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_store extends Model
{
    function createIt($store)
    {
        try {
            DB::insert(
                'INSERT INTO sales.stores (store_name, phone, email, street, city, state, zip_code) values (?, ?, ?, ?, ?, ?, ?)',
                [
                    $store->getStoreName(),
                    $store->getStorePhone(),
                    $store->getStoreEmail(),
                    $store->getStoreStreet(),
                    $store->getStoreCity(),
                    $store->getStoreState(),
                    $store->getStoreZipCode()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($store)
    {
        try {
            DB::update(
                'UPDATE sales.stores set store_name = ?, phone = ?, email = ?, street = ?, city = ?, state = ?, zip_code = ? WHERE store_id = ?',
                [
                    $store->getStoreName(),
                    $store->getStorePhone(),
                    $store->getStoreEmail(),
                    $store->getStoreStreet(),
                    $store->getStoreCity(),
                    $store->getStoreState(),
                    $store->getStoreZipCode(),
                    $store->getStoreId()
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
            'SELECT store_id, store_name, phone, email, street, city, state, zip_code FROM sales.stores',
        );

        $results = [];

        foreach ($query as $value) {
            $store = new Dao_store(
                $value->store_id,
                $value->store_name,
                $value->phone,
                $value->email,
                $value->street,
                $value->city,
                $value->state,
                $value->zip_code
            );
            array_push($results, $store);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $result = DB::select(
                'SELECT store_id, store_name, phone, email, street, city, state, zip_code FROM sales.stores WHERE store_id = ?',
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
                'DELETE FROM sales.stores WHERE store_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}