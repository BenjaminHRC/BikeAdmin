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
        $result = ['status' => 2, 'message' => 'Données non formatée'];

        if ($request->store_id != null && !empty($request->store_id) && $request->product_id != null && !empty($request->product_id)) {
            $stocks = new Dao_stock(
                $request->store_id,
                $request->product_id,
                $request->quantity,
            );
            // dd($this->Products->createIt($products));
            if ($this->Stocks->updateIt($stocks) === true) {
                $result = ['status' => 0, 'action' => 'update', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'update', 'message' => 'Données non sauvegarder', 'error' => $this->Stocks->updateIt($stocks)];
            }
        } else {
            $stocks = new Dao_stock(
                $request->store_id,
                $request->product_id,
                $request->quantity,
            );
            // dd($this->Products->createIt($products));
            if ($this->Stocks->createIt($stocks) === true) {
                $result = ['status' => 0, 'action' => 'create', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'create', 'message' => 'Données non sauvegarder', 'error' => $this->Stocks->createIt($stocks)];
            }
        }

        return json_encode($result);
    }

    function delete($store_id, $product_id)
    {
        $results = ['status' => 2, 'message' => 'Données non formatée'];

        if ($this->Stocks->dropIt($store_id, $product_id) === true) {
            $results = ['status' => 0, 'message' => 'Données supprimée'];
        } else {
            $results = ['status' => 1, 'message' => 'Données non supprimée', 'error' => $this->Stocks->dropIt($store_id, $product_id)];
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
