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
            $result = false;
        }
        return $result;
    }

    function findAll()
    {
        $query = DB::select(
            'SELECT product_id, product_name, model_year, list_price, brand_id, category_id FROM production.products'
        );

        $results = [];

        foreach ($query as $value) {
            $product = new Dao_product(
                $value->product_id,
                $value->product_name,
                $value->model_year,
                $value->list_price,
                $value->brand_id,
                $value->category_id
            );
            array_push($results, $product);
        }

        return $results;
    }

    function updateIt()
    {
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