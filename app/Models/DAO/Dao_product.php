<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_product extends Model
{
    private $product_id = null;
    private $product_name = null;
    private $model_year = null;
    private $list_price = null;
    private $brand_id = null;
    private $category_id = null;
    private $brand = null;
    private $category = null;

    function __construct($product_id, $product_name, $brand_id, $category_id, $model_year, $list_price)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->model_year = $model_year;
        $this->list_price = $list_price;
        $this->brand_id = $brand_id;
        $this->category_id = $category_id;
    }

    function getProductId()
    {
        return $this->product_id;
    }

    function setProductId($product_id)
    {
        return $this->product_id = $product_id;
    }

    function getProductName()
    {
        return $this->product_name;
    }

    function setProductName($product_name)
    {
        return $this->product_name = $product_name;
    }

    function getModelYear()
    {
        return $this->model_year;
    }

    function setModelYear($model_year)
    {
        return $this->model_year = $model_year;
    }

    function getListPrice()
    {
        return $this->list_price;
    }

    function setListPrice($list_price)
    {
        return $this->list_price = $list_price;
    }

    function getBrandId()
    {
        return $this->brand_id;
    }

    function setBrandId($brand_id)
    {
        return $this->brand_id = $brand_id;
    }

    function getCategoryId()
    {
        return $this->category_id;
    }

    function setCategoryId($category_id)
    {
        return $this->category_id = $category_id;
    }

    function getBrand()
    {
        return $this->brand;
    }

    function setBrand($brand)
    {
        return $this->brand = $brand;
    }

    function getCategory()
    {
        return $this->category;
    }

    function setCategory($category)
    {
        return $this->category = $category;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'model_year' => $this->model_year,
            'list_price' => $this->list_price,
            'brand' => json_decode($this->brand->toJSONPrivate(), true),
            'category' => json_decode($this->category->toJSONPrivate(), true)
        ]);
    }
}
