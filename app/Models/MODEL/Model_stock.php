<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_product;
use App\Models\DAO\Dao_stock;
use App\Models\DAO\Dao_store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_stock extends Model
{
    function createIt($stock)
    {
        try {
            // $queryAllStock = DB::query("SELECT store_id, product_id, quantity FROM production.stocks");
            // foreach ($queryAllStock as $value) {
            //     $allStock = new Dao_stock(
            //         $value->stock_id,
            //         $value->product_id,
            //         $value->quantity
            //     );
            //     if ($allStock->stock_id != $stock->getStoreId() || $allStock->product_id != $stock->getProductId()) {
            //         DB::insert(
            //             'INSERT INTO production.stocks (store_id, product_id, quantity) values (?, ?, ?)',
            //             [
            //                 $stock->getStoreId(),
            //                 $stock->getProductId(),
            //                 $stock->getQuantity(),
            //             ]
            //         );
            //     }
            // }

            DB::insert(
                'INSERT INTO production.stocks (store_id, product_id, quantity) values (?, ?, ?)',
                [
                    $stock->getStoreId(),
                    $stock->getProductId(),
                    $stock->getQuantity(),
                ]
            );

            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($stock)
    {
        try {
            DB::update(
                'UPDATE production.stocks set quantity = ? WHERE product_id = ? AND store_id = ?',
                [
                    $stock->getQuantity(),
                    $stock->getProductId(),
                    $stock->getStoreId(),
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
        $queryStock = DB::select(
            'SELECT s.store_id,
            s.product_id,
            s.quantity
            FROM production.stocks s'
        );

        $results = [];

        foreach ($queryStock as $value) {
            $stock = new Dao_stock(
                $value->store_id,
                $value->product_id,
                $value->quantity,
            );
            $queryStore = DB::select(
                'SELECT sto.store_id, sto.store_name, sto.phone, sto.email, sto.street, sto.city, sto.state, sto.zip_code 
                FROM sales.stores sto
                WHERE sto.store_id = ?',
                [$stock->getStoreId()]
            );
            $queryProduct = DB::select(
                'SELECT p.product_id, p.product_name, p.model_year, p.list_price, p.category_id, p.brand_id 
                FROM production.products p
                WHERE p.product_id = ?',
                [$stock->getProductId()]
            );
            foreach ($queryStore as $value) {
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
                $stock->setStore($store);
            }
            foreach ($queryProduct as $value) {
                $product = new Dao_product(
                    $value->product_id,
                    $value->product_name,
                    $value->brand_id,
                    $value->category_id,
                    $value->model_year,
                    $value->list_price,
                );
                $stock->setProduct($product);
            }
            array_push($results, $stock);
        }

        return $results;
    }

    function findIt($store_id, $product_id)
    {
        try {
            $queryStock = DB::select(
                'SELECT s.store_id,
                s.product_id,
                s.quantity
                FROM production.stocks s
                WHERE s.store_id = ? AND s.product_id = ?',
                [$store_id, $product_id]
            );

            foreach ($queryStock as $value) {
                $stock = new Dao_stock(
                    $value->store_id,
                    $value->product_id,
                    $value->quantity,
                );
                $queryStore = DB::select(
                    'SELECT sto.store_id, sto.store_name, sto.phone, sto.email, sto.street, sto.city, sto.state, sto.zip_code 
                    FROM sales.stores sto
                    WHERE sto.store_id = ?',
                    [$stock->getStoreId()]
                );
                $queryProduct = DB::select(
                    'SELECT p.product_id, p.product_name, p.model_year, p.list_price, p.category_id, p.brand_id 
                    FROM production.products p
                    WHERE p.product_id = ?',
                    [$stock->getProductId()]
                );
                foreach ($queryStore as $value) {
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
                    $stock->setStore($store);
                }
                foreach ($queryProduct as $value) {
                    $product = new Dao_product(
                        $value->product_id,
                        $value->product_name,
                        $value->brand_id,
                        $value->category_id,
                        $value->model_year,
                        $value->list_price,
                    );
                    $stock->setProduct($product);
                }
                $results = $stock;
            }
            return $results;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function dropIt($store_id, $product_id)
    {
        try {
            DB::delete(
                'DELETE FROM production.stocks WHERE store_id = ? AND product_id = ?',
                [$store_id, $product_id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }
}
