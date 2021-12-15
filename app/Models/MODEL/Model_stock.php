<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_stock extends Model
{
    function createIt($stock)
    {
        try {
            DB::insert(
                'INSERT INTO production.stocks (store_id, product_id, quantity) values (?, ?, ?)',
                [
                    $stock->getStoreId(),
                    $stock->getProductId(),
                    $stock->getQuantity()
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
                'UPDATE production.products set product_name = ?, model_year = ?, list_price = ?, brand_id = ?, category_id = ? WHERE product_id = ?',
                [
                    $stock->getProductName(),
                    $stock->getModelYear(),
                    $stock->getPrice(),
                    $stock->getBrandId(),
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
            'SELECT sr.store_id,
            sr.store_name,
            s.quantity
            FROM production.stocks s
            LEFT JOIN sales.stores sr ON sr.store_id = s.store_id'

        );

        $results = [];

        foreach ($query as $value) {
            $product = new Dao_stock(
                $value->product_id,
                $value->product_name,
                $value->model_year,
                $value->list_price,
                $value->brand_name,
                $value->category_name
            );
            array_push($results, $product);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $result = DB::select(
                'SELECT stock_id, product_id, quantity FROM production.stocks WHERE product_id=?',
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
                'DELETE FROM production.products WHERE product_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}