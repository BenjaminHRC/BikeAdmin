<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_order;
use App\Models\DAO\Dao_stock;
use App\Models\MODEL\Model_customer;
use App\Models\MODEL\Model_order;
use App\Models\MODEL\Model_staff;
use App\Models\MODEL\Model_store;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $Orders;
    private $Staffs;
    private $Stores;
    private $Customers;

    function __construct()
    {
        $this->Orders = new Model_order();
        $this->Staffs = new Model_staff();
        $this->Stores = new Model_store();
        $this->Customers = new Model_customer();
    }

    function index()
    {
        $query['staffs'] = $this->Staffs->findAll();
        $query['stores'] = $this->Stores->findAll();
        $query['customers'] = $this->Customers->findAll();

        $valuesStaffs = [];
        $valuesStores = [];
        $valuesCustomers = [];

        foreach ($query['staffs'] as $value) {
            array_push($valuesStaffs, json_decode($value->toJSONPrivate(), true));
        }
        foreach ($query['stores'] as $value) {
            array_push($valuesStores, json_decode($value->toJSONPrivate(), true));
        }
        foreach ($query['customers'] as $value) {
            array_push($valuesCustomers, json_decode($value->toJSONPrivate(), true));
        }

        $results['staffs'] = $valuesStaffs;
        $results['stores'] = $valuesStores;
        $results['customers'] = $valuesCustomers;

        return json_encode($results);
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Orders->findIt($id);
        } else {
            return ["status" => 1, "message" => "ID null ou undefined"];
        }
    }

    function list()
    {
        $query = $this->Orders->findAll();

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
            $orders = new Dao_order(
                $request->order_id,
                $request->order_status,
                $request->order_date,
                $request->required_date,
                $request->shipped_date,
                $request->customer_id,
                $request->store_id,
                $request->staff_id
            );
            // dd($this->Products->createIt($products));
            if ($this->Orders->updateIt($orders) === true) {
                $result = ['status' => 0, "action" => "update", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "update", 'message' => 'Données non sauvegarder'];
            }
        } else {
            $orders = new Dao_stock(
                null,
                $request->order_status,
                $request->order_date,
                $request->required_date,
                $request->shipped_date,
                $request->customer_id,
                $request->store_id,
                $request->staff_id
            );
            // dd($this->Products->createIt($products));
            if ($this->Orders->createIt($orders) === true) {
                $result = ['status' => 0, "action" => "create", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "create", 'message' => 'Données non sauvegarder'];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ["status" => 2, "message" => "Données non formatée"];

        if ($this->Orders->dropIt($id) === true) {
            $results = ["status" => 0, "message" => "Données supprimée"];
        } else {
            $results = ["status" => 1, "message" => "Données non supprimée", "error" => $this->Orders->dropIt($id)];
        }

        return json_encode($results);
    }
}