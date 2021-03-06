<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_stock;
use App\Models\MODEL\Model_product;
use App\Models\MODEL\Model_stock;
use App\Models\MODEL\Model_store;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private $Products;
    private $Stores;
    private $Stocks;

    function __construct()
    {
        $this->Stocks = new Model_stock();
        $this->Products = new Model_product();
        $this->Stores = new Model_store();
    }

    function index()
    {
        $queryStore = $this->Stores->findAll();
        $queryProduct = $this->Products->findAll();

        $valuesStore = [];
        $valuesProduct = [];

        foreach ($queryStore as $value) {
            array_push($valuesStore, json_decode($value->toJSONPrivate(), true));
        }
        foreach ($queryProduct as $value) {
            array_push($valuesProduct, json_decode($value->toJSONPrivate(), true));
        }

        $results['stores'] = $valuesStore;
        $results['products'] = $valuesProduct;


        return json_encode($results);
    }

    function view($store_id, $product_id)
    {
        if ($store_id != null && !empty($store_id) && $product_id != null && !empty($product_id)) {
            return $this->Stocks->findIt($store_id, $product_id)->toJSONPrivate();
        } else {
            return ['status' => 1, 'message' => 'ID null ou undefined'];
        }
    }

    function list()
    {
        $query = $this->Stocks->findAll();

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
        $allStock = $this->Stocks->findAll();
        foreach ($allStock as $value) {
            $val = json_decode($value->toJSONPrivate());
            if ($val->store_id == $request->store_id && $val->product_id == $request->product_id) {
                $stocks = new Dao_stock(
                    $request->store_id,
                    $request->product_id,
                    $request->quantity,
                );
                if ($this->Stocks->updateIt($stocks) === true) {
                    return json_encode(['status' => 0, 'action' => 'update', 'message' => 'Donn??es sauvegarder']);
                } else {
                    return json_encode(['status' => 1, 'action' => 'update', 'message' => 'Donn??es non sauvegarder', 'error' => $this->Stocks->updateIt($stocks)]);
                }
            }
        }
        foreach ($allStock as $value) {
            $val = json_decode($value->toJSONPrivate());
            if ($val->store_id != $request->store_id || $val->product_id != $request->product_id) {
                $stocks = new Dao_stock(
                    $request->store_id,
                    $request->product_id,
                    $request->quantity,
                );
                if ($this->Stocks->createIt($stocks) === true) {
                    return  json_encode(['status' => 0, 'action' => 'create', 'message' => 'Donn??es sauvegarder']);
                } else {
                    return json_encode(['status' => 1, 'action' => 'create', 'message' => 'Donn??es non sauvegarder', 'error' => $this->Stocks->createIt($stocks)]);
                }
            }
        }
        return json_encode(['status' => 2, 'message' => 'Donn??es non format??e']);
    }

    function delete($store_id, $product_id)
    {
        $results = ['status' => 2, 'message' => 'Donn??es non format??e'];

        if ($this->Stocks->dropIt($store_id, $product_id) === true) {
            $results = ['status' => 0, 'message' => 'Donn??es supprim??e'];
        } else {
            $results = ['status' => 1, 'message' => 'Donn??es non supprim??e', 'error' => $this->Stocks->dropIt($store_id, $product_id)];
        }

        return json_encode($results);
    }

    function getTopStaff($date)
    {
        if ($date !== null && !empty($date)) {
            return $this->Staffs->top_staffs($date);
        } else {
            return [
                'status' => 1,
                'message' => 'Date null ou undefined',
            ];
        }
    }
}
