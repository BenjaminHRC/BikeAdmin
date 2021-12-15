<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_order extends Model
{
    function createIt($order)
    {
        try {
            DB::insert(
                'INSERT INTO sales.orders (order_status, order_date, require_date, shipped_date, customer_id, store_id, staff_id) values (?, ?, ?, ?, ?, ?, ?)',
                [
                    $order->getOrderStatus(),
                    $order->getOrderDate(),
                    $order->getRequiredDate(),
                    $order->getShippedDate(),
                    $order->getCustomerId(),
                    $order->getStoreId(),
                    $order->getStaffId()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($order)
    {
        try {
            DB::update(
                'UPDATE sales.orders 
                set order_status = ?, order_date = ?, required_date = ?, shipped_date = ?, customer_id = ?, store_id = ?, staff_id = ? 
                WHERE order_id = ?',
                [
                    $order->getOrderStatus(),
                    $order->getOrderDate(),
                    $order->getRequiredDate(),
                    $order->getShippedDate(),
                    $order->getCustomerId(),
                    $order->getStoreId(),
                    $order->getStaffId(),
                    $order->getOrderId()
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
            'SELECT order_id,
            order_status,
            order_date,
            required_date,
            shipped_date,
            customer_id,
            store_id,
            staff_id
            FROM sales.orders'
        );

        $results = [];

        foreach ($query as $value) {
            $order = new Dao_order(
                $value->order_id,
                $value->order_status,
                $value->order_date,
                $value->required_date,
                $value->shipped_date,
                $value->customer_id,
                $value->store_id,
                $value->staff_id
            );
            array_push($results, $order);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $result = DB::select(
                'SELECT order_id, order_status, order_date, required_date, shipped_date, customer_id, store_id, staff_id FROM sales.orders WHERE order_id=?',
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
                'DELETE FROM sales.orders WHERE order_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}