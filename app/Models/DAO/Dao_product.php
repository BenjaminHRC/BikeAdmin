<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_product extends Model
{
    private $id = null;
    private $name = null;
    private $model_year = null;
    private $price = null;
    private $brand_id = null;
    private $category_id = null;


    function __construct($id, $name, $model_year, $price, $brand_id, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->model_year = $model_year;
        $this->price = $price;
        $this->brand_id = $brand_id;
        $this->category_id = $category_id;
    }

    function getProductId()
    {
        return $this->id;
    }

    function setProductId($id)
    {
        return $this->id = $id;
    }

    function getProductName()
    {
        return $this->name;
    }

    function setProductName($name)
    {
        return $this->name = $name;
    }

    function getModelYear()
    {
        return $this->model_year;
    }

    function setModelYear($model_year)
    {
        return $this->model_year = $model_year;
    }

    function getPrice()
    {
        return $this->price;
    }

    function setPrice($price)
    {
        return $this->price = $price;
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

    public function toJSONPrivate()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'model_year' => $this->model_year,
            'price' => $this->price,
            'brand_id' => $this->brand_id,
            'category' => $this->category_id
        ]);
    }
}