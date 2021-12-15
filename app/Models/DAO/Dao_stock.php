<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_stock extends Model
{
    private $store_id = null;
    private $product_id = null;
    private $quantity = null;

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

    public function toJSONPrivate()
    {
        return json_encode([
            'store_id' => $this->id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity
        ]);
    }
}