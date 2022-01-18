<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_order_item;
use App\Models\MODEL\Model_order_item;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    private $OrderItems;

    function __construct()
    {
        $this->OrderItems = new Model_order_item();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            $results = [];
            // var_dump($this->OrderItems->findIt($id));
            foreach ($this->OrderItems->findIt($id) as $value) {
                // var_dump($value);
                array_push($results, json_decode($value->toJSONPrivate()));
            }
            $results['data'] = $results;
            return $results; // ->toJSONPrivate();
        } else {
            return ['status' => 1, 'message' => 'ID null ou undefined'];
        }
    }

    function list()
    {
        $query = $this->OrderItems->findAll();
        // var_dump($query);
        $values = [];

        foreach ($query as $value) {
            // $value->setLastName(strtolower($value->getLastName()));
            array_push($values, json_decode($value->toJSONPrivate(), true));
        }

        $results['data'] = $values;

        return json_encode($results);
    }

    function save(Request $request)
    {
        $result = ['status' => 2, 'message' => 'Données non formatée'];

        if ($request->order_id != null && !empty($request->order_id)) {
            $order_items = new Dao_order_item(
                $request->order_id,
                $request->item_id,
                $request->product_id,
                $request->quantity,
                $request->list_price,
                $request->discount
            );
            // dd($this->Products->createIt($products));
            if ($this->OrderItems->updateIt($order_items) === true) {
                $result = ['status' => 0, 'action' => 'update', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'update', 'message' => 'Données non sauvegarder', 'error' => $this->OrderItems->updateIt($order_items)];
            }
        } else {
            $order_items = new Dao_order_item(
                $request->order_id,
                null,
                $request->product_id,
                $request->quantity,
                $request->list_price,
                $request->discount
            );
            // dd($this->Products->createIt($products));
            if ($this->OrderItems->createIt($order_items) === true) {
                $result = ['status' => 0, 'action' => 'create', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'create', 'message' => 'Données non sauvegarder', 'error' => $this->OrderItems->createIt($order_items)];
            }
        }

        return json_encode($result);
    }

    function delete($order_id, $item_id)
    {
        $results = ['status' => 2, 'message' => 'Données non formatée'];

        if ($this->OrderItems->dropIt($order_id, $item_id) === true) {
            $results = ['status' => 0, 'message' => 'Données supprimée'];
        } else {
            $results = ['status' => 1, 'message' => 'Données non supprimée', 'error' => $this->OrderItems->dropIt($order_id, $item_id)];
        }

        return json_encode($results);
    }
}
