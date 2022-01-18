<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_customer;
use App\Models\DAO\Dao_order;
use App\Models\DAO\Dao_order_item;
use App\Models\DAO\Dao_staff;
use App\Models\DAO\Dao_store;
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
        $queryOrder = DB::select(
            'SELECT o.order_id,o.order_status,o.order_date,o.required_date,o.shipped_date,o.customer_id,o.store_id,o.staff_id
            FROM sales.orders o'
        );

        $results = [];

        foreach ($queryOrder as $value) {
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
            $queryCustomer = DB::select(
                'SELECT c.customer_id,c.first_name,c.last_name,c.phone,c.email,c.street,c.city,c.state,c.zip_code
                FROM sales.customers c
                LEFT JOIN sales.orders o ON o.order_id = c.customer_id
                WHERE c.customer_id = ?',
                [$order->getCustomerId()]
            );
            $queryStore = DB::select(
                'SELECT sto.store_id,sto.store_name,sto.phone,sto.email,sto.street,sto.city,sto.state,sto.zip_code
                FROM sales.stores sto
                LEFT JOIN sales.orders o ON o.order_id = sto.store_id
                WHERE sto.store_id = ?',
                [$order->getStoreId()]
            );
            $queryStaff = DB::select(
                'SELECT sta.staff_id,sta.first_name,sta.last_name,sta.email,sta.phone,sta.active,sta.store_id,sta.manager_id
                FROM sales.staffs sta
                LEFT JOIN sales.orders o ON o.order_id = sta.staff_id
                WHERE sta.staff_id = ?',
                [$order->getStaffId()]
            );
            foreach ($queryCustomer as $value) {
                $customer = new Dao_customer(
                    $value->customer_id,
                    $value->first_name,
                    $value->last_name,
                    $value->phone,
                    $value->email,
                    $value->street,
                    $value->city,
                    $value->state,
                    $value->zip_code,
                );
                $listTmp = $order->getCustomer();
                $listTmp[] = $customer;
                $order->setCustomer($customer);
            }
            foreach ($queryStore as $value) {
                $store = new Dao_store(
                    $value->store_id,
                    $value->store_name,
                    $value->phone,
                    $value->email,
                    $value->street,
                    $value->city,
                    $value->state,
                    $value->zip_code,
                );
                $listTmp = $order->getStore();
                $listTmp[] = $store;
                $order->setStore($store);
            }
            foreach ($queryStaff as $value) {
                $staff = new Dao_staff(
                    $value->staff_id,
                    $value->first_name,
                    $value->last_name,
                    $value->email,
                    $value->phone,
                    $value->active,
                    $value->store_id,
                    $value->manager_id
                );
                $listTmp = $order->getStaff();
                $listTmp[] = $staff;
                $order->setStaff($staff);
            }
            $results[] = $order;
            // var_dump($results);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $queryOrder = DB::select(
                'SELECT o.order_id,o.order_status,o.order_date,o.required_date,o.shipped_date,o.customer_id,o.store_id,o.staff_id
                FROM sales.orders o
                WHERE o.order_id = ?',
                [$id]
            );
            foreach ($queryOrder as $value) {
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
                $queryCustomer = DB::select(
                    'SELECT c.customer_id,c.first_name,c.last_name,c.phone,c.email,c.street,c.city,c.state,c.zip_code
                    FROM sales.customers c
                    LEFT JOIN sales.orders o ON o.order_id = c.customer_id
                    WHERE c.customer_id = ?',
                    [$order->getCustomerId()]
                );
                $queryStore = DB::select(
                    'SELECT sto.store_id,sto.store_name,sto.phone,sto.email,sto.street,sto.city,sto.state,sto.zip_code
                    FROM sales.stores sto
                    LEFT JOIN sales.orders o ON o.order_id = sto.store_id
                    WHERE sto.store_id = ?',
                    [$order->getStoreId()]
                );
                $queryStaff = DB::select(
                    'SELECT sta.staff_id,sta.first_name,sta.last_name,sta.email,sta.phone,sta.active,sta.store_id,sta.manager_id
                    FROM sales.staffs sta
                    LEFT JOIN sales.orders o ON o.order_id = sta.staff_id
                    WHERE sta.staff_id = ?',
                    [$order->getStaffId()]
                );

                foreach ($queryCustomer as $value) {
                    $customer = new Dao_customer(
                        $value->customer_id,
                        $value->first_name,
                        $value->last_name,
                        $value->phone,
                        $value->email,
                        $value->street,
                        $value->city,
                        $value->state,
                        $value->zip_code,
                    );
                    $order->setCustomer($customer);
                }
                foreach ($queryStore as $value) {
                    $store = new Dao_store(
                        $value->store_id,
                        $value->store_name,
                        $value->phone,
                        $value->email,
                        $value->street,
                        $value->city,
                        $value->state,
                        $value->zip_code,
                    );
                    $order->setStore($store);
                }
                foreach ($queryStaff as $value) {
                    $staff = new Dao_staff(
                        $value->staff_id,
                        $value->first_name,
                        $value->last_name,
                        $value->email,
                        $value->phone,
                        $value->active,
                        $value->store_id,
                        $value->manager_id
                    );
                    $order->setStaff($staff);
                }
                $results = $order;
            }
            return $results;
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
