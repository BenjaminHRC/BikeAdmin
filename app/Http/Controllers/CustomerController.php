<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_customer;
use App\Models\MODEL\Model_customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $Customers;

    function __construct()
    {
        $this->Customers = new Model_customer();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Customers->findIt($id)->toJSONPrivate();
        } else {
            return ['status' => 1, 'message' => 'ID null ou undefined'];
        }
    }

    function list()
    {
        $query = $this->Customers->findAll();

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

        if ($request->customer_id != null && !empty($request->customer_id)) {
            $customers = new Dao_customer(
                $request->customer_id,
                $request->first_name,
                $request->last_name,
                $request->phone,
                $request->email,
                $request->street,
                $request->city,
                $request->state,
                $request->zip_code
            );
            // dd($this->Products->createIt($products));
            if ($this->Customers->updateIt($customers) === true) {
                $result = ['status' => 0, 'action' => 'update', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'update', 'message' => 'Données non sauvegarder', 'error' => $this->Customers->updateIt($customers)];
            }
        } else {
            $customers = new Dao_customer(
                null,
                $request->first_name,
                $request->last_name,
                $request->phone,
                $request->email,
                $request->street,
                $request->city,
                $request->state,
                $request->zip_code
            );
            // dd($this->Products->createIt($products));
            if ($this->Customers->createIt($customers) === true) {
                $result = ['status' => 0, 'action' => 'create', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'create', 'message' => 'Données non sauvegarder', 'error' => $this->Customers->createIt($customers)];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ['status' => 2, 'message' => 'Données non formatée'];

        if ($this->Customers->dropIt($id) === true) {
            $results = ['status' => 0, 'message' => 'Données supprimée'];
        } else {
            $results = ['status' => 1, 'message' => 'Données non supprimée', 'error' => $this->Customers->dropIt($id)];
        }

        return json_encode($results);
    }
}
