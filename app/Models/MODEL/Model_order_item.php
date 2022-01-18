<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_brand;
use App\Models\DAO\Dao_category;
use App\Models\DAO\Dao_order_item;
use App\Models\DAO\Dao_product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_order_item extends Model
{
    function createIt($order_item)
    {
        try {
            DB::insert(
                'INSERT INTO sales.order_items (order_id, item_id, product_id, quantity, list_price, discount) values (?, ?, ?, ?, ?, ?)',
                [
                    $order_item->getOrderItemOrderId(),
                    $order_item->getOrderItemItemId(),
                    $order_item->getOrderItemProductId(),
                    $order_item->getOrderItemQuantity(),
                    $order_item->getOrderItemListPrice(),
                    $order_item->getOrderItemDiscount()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($order_item)
    {
        try {
            DB::update(
                'UPDATE sales.order_items set product_id = ?, quantity = ?, list_price = ?, discount = ? WHERE item_id = ? AND order_id = ?',
                [
                    $order_item->getOrderItemProductId(),
                    $order_item->getOrderItemQuantity(),
                    $order_item->getOrderItemListPrice(),
                    $order_item->getOrderItemDiscount(),
                    $order_item->getOrderItemItemId(),
                    $order_item->getOrderItemOrderId(),
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
        $queryOrderItem = DB::select(
            'SELECT order_id, item_id, product_id, quantity, list_price, discount FROM sales.order_items',
        );

        $results = [];

        foreach ($queryOrderItem as $value) {
            $order_item = new Dao_order_item(
                $value->order_id,
                $value->item_id,
                $value->product_id,
                $value->quantity,
                $value->list_price,
                $value->discount
            );

            $queryProduct = DB::select(
                'SELECT p.product_id, p.product_name, p.brand_id, p.category_id, p.model_year, p.list_price 
                    FROM production.products p WHERE p.product_id = ?',
                [$order_item->getOrderItemProductId()]
            );

            foreach ($queryProduct as $value) {
                $product = new Dao_product(
                    $value->product_id,
                    $value->product_name,
                    $value->brand_id,
                    $value->category_id,
                    $value->model_year,
                    $value->list_price
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
                // var_dump($product);
                $order_item->setOrderItemProduct($product);
            }
            $results[] = $order_item;
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $queryOrderItem = DB::select(
                'SELECT oi.order_id, oi.item_id, oi.product_id, oi.quantity, oi.list_price, oi.discount 
                FROM sales.order_items oi 
                WHERE oi.order_id = ?',
                [$id]
            );

            $results = [];

            foreach ($queryOrderItem as $value) {
                $order_item = new Dao_order_item(
                    $value->order_id,
                    $value->item_id,
                    $value->product_id,
                    $value->quantity,
                    $value->list_price,
                    $value->discount
                );

                $queryProduct = DB::select(
                    'SELECT p.product_id, p.product_name, p.brand_id, p.category_id, p.model_year, p.list_price 
                    FROM production.products p WHERE p.product_id = ?',
                    [$order_item->getOrderItemProductId()]
                );

                foreach ($queryProduct as $value) {
                    $product = new Dao_product(
                        $value->product_id,
                        $value->product_name,
                        $value->brand_id,
                        $value->category_id,
                        $value->model_year,
                        $value->list_price
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
                    // var_dump($product);
                    $order_item->setOrderItemProduct($product);
                }
                // $order_item
                // var_dump($order_item);
                $results[] = $order_item;
            }
            return $results;
        } catch (\Exception $e) {
            $result = ['error' => 'il y a une erreur', 'message' => $e->getMessage()];
        }

        return $result;
    }

    function dropIt($order_id, $item_id)
    {
        try {
            DB::delete(
                'DELETE FROM sales.order_items WHERE item_id = ? AND order_id = ?',
                [$item_id, $order_id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}
