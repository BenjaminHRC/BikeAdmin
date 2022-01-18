<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_stock extends Model
{
    private $store_id = null;
    private $product_id = null;
    private $quantity = null;
    private $store = null;
    private $product = null;

    function __construct($store_id, $product_id, $quantity)
    {
        $this->store_id = $store_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    function getStoreId()
    {
        return $this->store_id;
    }

    function setStoreId($store_id)
    {
        return $this->store_id = $store_id;
    }

    function getProductId()
    {
        return $this->product_id;
    }

    function setProductId($id)
    {
        return $this->product_id = $id;
    }

    function getQuantity()
    {
        return $this->quantity;
    }

    function setQuantity($quantity)
    {
        return $this->quantity = $quantity;
    }

    function getStore()
    {
        return $this->store;
    }

    function setStore($store)
    {
        return $this->store = $store;
    }

    function getProduct()
    {
        return $this->product;
    }

    function setProduct($product)
    {
        return $this->product = $product;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'store_id' => $this->store_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'store' => json_decode($this->store->toJSONPrivate()),
            'product' => json_decode($this->product->toJSONPrivate())
        ]);
    }
}
