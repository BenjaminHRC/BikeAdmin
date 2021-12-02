<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_brand;
use App\Models\DAO\Dao_category;
use App\Models\DAO\Dao_product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Model_product extends Model
{
    function createIt($product)
    {
        try {
            DB::insert(
                'INSERT INTO production.products (product_name, model_year, list_price, brand_id, category_id) values (?, ?, ?, ?, ?)',
                [
                    $product->getProductName(),
                    $product->getModelYear(),
                    $product->getPrice(),
                    $product->getBrandId(),
                    $product->getCategoryId()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($product)
    {
        try {
            DB::update(
                'UPDATE production.products set product_name = ?, model_year = ?, list_price = ?, brand_id = ?, category_id = ? WHERE product_id = ?',
                [
                    $product->getProductName(),
                    $product->getModelYear(),
                    $product->getPrice(),
                    $product->getBrandId(),
                    $product->getCategoryId(),
                    $product->getProductId()
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
            'SELECT p.product_id, 
            p.product_name, 
            p.model_year, 
            p.list_price, 
            c.category_name, 
            b.brand_name 
            FROM production.products p
            LEFT JOIN production.brands b ON p.brand_id = b.brand_id 
            LEFT JOIN  production.categories c ON p.category_id = c.category_id',
        );

        $results = [];

        foreach ($query as $value) {
            $product = new Dao_product(
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
                'SELECT product_id, product_name, model_year, list_price, brand_id, category_id FROM production.products WHERE product_id=?',
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