<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_brand;
use App\Models\DAO\Dao_category;
use App\Models\DAO\Dao_product;
use App\Models\DAO\Dao_stock;
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
                'UPDATE production.products set product_name = ?, model_year = ?, list_price = ?, brand_id = ?, category_id = ? 
                WHERE product_id = ?',
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
        $queryProduct = DB::select(
            'SELECT p.product_id, p.product_name, p.model_year, p.list_price, p.category_id, p.brand_id 
            FROM production.products p',
        );
        $results = [];
        foreach ($queryProduct as $value) {
            $product = new Dao_product(
                $value->product_id,
                $value->product_name,
                $value->brand_id,
                $value->category_id,
                $value->model_year,
                $value->list_price,
            );
            $queryBrand = DB::select(
                'SELECT b.brand_id, b.brand_name FROM production.brands b WHERE b.brand_id = ?',
                [$product->getBrandId()],
            );
            $queryCategory = DB::select(
                'SELECT c.category_id, c.category_name FROM production.categories c WHERE c.category_id = ?',
                [$product->getCategoryId()]
            );
            foreach ($queryBrand as $value) {
                $brand = new Dao_brand(
                    $value->brand_id,
                    $value->brand_name
                );
                $product->setBrand($brand);
            }
            foreach ($queryCategory as $value) {
                $category = new Dao_category(
                    $value->category_id,
                    $value->category_name
                );
                $product->setCategory($category);
            }
            $results[] = $product;
        }
        return $results;
    }

    function findIt($id)
    {
        try {
            $queryProduct = DB::select(
                'SELECT p.product_id, p.product_name, p.model_year, p.list_price, p.category_id, p.brand_id 
                FROM production.products p
                WHERE p.product_id = ?',
                [$id]
            );
            foreach ($queryProduct as $value) {
                $product = new Dao_product(
                    $value->product_id,
                    $value->product_name,
                    $value->brand_id,
                    $value->category_id,
                    $value->model_year,
                    $value->list_price,

                );
                $queryBrand = DB::select(
                    'SELECT b.brand_id, b.brand_name FROM production.brands b WHERE b.brand_id = ?',
                    [$product->getBrandId()],
                );
                $queryCategory = DB::select(
                    'SELECT c.category_id, c.category_name FROM production.categories c WHERE c.category_id = ?',
                    [$product->getCategoryId()]
                );
                foreach ($queryBrand as $value) {
                    $brand = new Dao_brand(
                        $value->brand_id,
                        $value->brand_name
                    );
                    $product->setBrand($brand);
                }
                foreach ($queryCategory as $value) {
                    $category = new Dao_category(
                        $value->category_id,
                        $value->category_name
                    );
                    $product->setCategory($category);
                }
                $results = $product;
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
                'DELETE FROM production.products WHERE product_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function top_products()
    {
        try {
            $query = DB::select(
                'SELECT * FROM production.top_products'
            );
            return $query;
        } catch (\Exception $e) {
            return $e;
        }
    }

    function nb_products()
    {
        try {
            $query = DB::select(
                'SELECT * FROM production.view_quantity_in_stock'
            );
            return $query;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
