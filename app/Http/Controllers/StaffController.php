<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_staff;
use App\Models\MODEL\Model_staff;
use App\Models\MODEL\Model_store;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    private $Staffs;
    private $Stores;

    function __construct()
    {
        $this->Staffs = new Model_staff();
        $this->Stores = new Model_store();
    }

    function index()
    {
        $query = $this->Stores->findAll();

        $values = [];

        foreach ($query as $value) {
            array_push($values, json_decode($value->toJSONPrivate(), true));
        }

        $results = $values;

        return json_encode($results);
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Staffs->findIt($id);
        } else {
            return ['status' => 1, 'message' => 'ID null ou undefined'];
        }
    }

    function list()
    {
        $query = $this->Staffs->findAll();

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

        if ($request->staff_id != null && !empty($request->staff_id)) {
            $staffs = new Dao_staff(
                $request->staff_id,
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->phone,
                $request->active,
                $request->store_id,
                $request->manager_id
            );
            // dd($this->Products->createIt($products));
            if ($this->Staffs->updateIt($staffs) === true) {
                $result = ['status' => 0, 'action' => 'update', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'update', 'message' => 'Données non sauvegarder', 'error' => $this->Staffs->updateIt($staffs)];
            }
        } else {
            $staffs = new Dao_staff(
                null,
                $request->first_name,
                $request->last_name,
                $request->email,
                $request->phone,
                $request->active,
                $request->store_id,
                $request->manager_id
            );
            // dd($this->Products->createIt($products));
            if ($this->Staffs->createIt($staffs) === true) {
                $result = ['status' => 0, 'action' => 'create', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'create', 'message' => 'Données non sauvegarder', 'error' => $this->Staffs->createIt($staffs)];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ['status' => 2, 'message' => 'Données non formatée'];

        if ($this->Staffs->dropIt($id) === true) {
            $results = ['status' => 0, 'message' => 'Données supprimée'];
        } else {
            $results = ['status' => 1, 'message' => 'Données non supprimée', 'error' => $this->Staffs->dropIt($id)];
        }

        return json_encode($results);
    }
}