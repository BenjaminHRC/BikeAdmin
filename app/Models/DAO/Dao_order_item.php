<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_order_item extends Model
{
    private $order_id = null;
    private $item_id = null;
    private $product_id = null;
    private $quantity = null;
    private $list_price = null;
    private $discount = null;
    private $product = null;
    private $order_items = array();

    function __construct($order_id, $item_id, $product_id, $quantity, $list_price, $discount)
    {
        $this->order_id = $order_id;
        $this->item_id = $item_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->list_price = $list_price;
        $this->discount = $discount;
        $this->producte = null;
        $this->order_items = array();
    }

    function getOrderItemOrderId()
    {
        return $this->order_id;
    }

    function setOrderItemOrderId($order_id)
    {
        return $this->order_id = $order_id;
    }

    function getOrderItemItemId()
    {
        return $this->item_id;
    }

    function setitem_idItemId($item_id)
    {
        return $this->item_id = $item_id;
    }

    function getOrderItemProductId()
    {
        return $this->product_id;
    }

    function setOrderItemProductId($product_id)
    {
        return $this->product_id = $product_id;
    }

    function getOrderItemQuantity()
    {
        return $this->quantity;
    }

    function setOrderItemQuantity($quantity)
    {
        return $this->quantity = $quantity;
    }

    function getOrderItemListPrice()
    {
        return $this->list_price;
    }

    function setOrderItemListPrice($list_price)
    {
        return $this->list_price = $list_price;
    }

    function getOrderItemDiscount()
    {
        return $this->discount;
    }

    function setOrderItemDiscount($discount)
    {
        return $this->discount = $discount;
    }

    function getOrderItemProduct()
    {
        return $this->product;
    }

    function setOrderItemProduct($product)
    {
        // var_dump($product);
        return $this->product = $product;
    }

    function getOrderItemList()
    {
        return $this->order_item_list;
    }

    function setOrderItemList($order_items)
    {
        // var_dump($order_items);
        return $this->order_items = $order_items;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'order_id' => $this->order_id,
            'item_id' => $this->item_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'list_price' => $this->list_price,
            'discount' => $this->discount,
            'product' => json_decode($this->product->toJSONPrivate())
        ]);
    }
}
