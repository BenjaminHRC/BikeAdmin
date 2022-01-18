<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_store;
use App\Models\MODEL\Model_store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $Stores;

    function __construct()
    {
        $this->Stores = new Model_store();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Stores->findIt($id)->toJSONPrivate();
        } else {
            return ['status' => 1, 'message' => 'ID null ou undefined'];
        }
    }

    function list()
    {
        $query = $this->Stores->findAll();
        $values = [];
        foreach ($query as $value) {
            array_push($values, json_decode($value->toJSONPrivate(), true));
        }
        $results['data'] = $values;
        return json_encode($results);
    }

    function save(Request $request)
    {
        $result = ['status' => 2, 'message' => 'Données non formatée'];
        if ($request->store_id != null && !empty($request->store_id)) {
            $stores = new Dao_store(
                $request->store_id,
                $request->store_name,
                $request->phone,
                $request->email,
                $request->street,
                $request->city,
                $request->state,
                $request->zip_code
            );
            if ($this->Stores->updateIt($stores) === true) {
                $result = [
                    'status' => 0,
                    'action' => 'update',
                    'message' => 'Données sauvegarder'
                ];
            } else {
                $result = [
                    'status' => 1,
                    'action' => 'update',
                    'message' => 'Données non sauvegarder',
                    'error' => $this->Stores->updateIt($stores)
                ];
            }
        } else {
            $stores = new Dao_store(
                null,
                $request->store_name,
                $request->phone,
                $request->email,
                $request->street,
                $request->city,
                $request->state,
                $request->zip_code
            );
            if ($this->Stores->createIt($stores) === true) {
                $result = [
                    'status' => 0,
                    'action' => 'create',
                    'message' => 'Données sauvegarder'
                ];
            } else {
                $result = [
                    'status' => 1,
                    'action' => 'create',
                    'message' => 'Données non sauvegarder',
                    'error' => $this->Stores->createIt($stores)
                ];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ['status' => 2, 'message' => 'Données non formatée'];
        if ($this->Stores->dropIt($id) === true) {
            $results = [
                'status' => 0,
                'message' => 'Données supprimée'
            ];
        } else {
            $results = [
                'status' => 1,
                'message' => 'Données non supprimée',
                'error' => $this->Stores->dropIt($id)
            ];
        }
        return json_encode($results);
    }

    function getCAStore($date)
    {
        if ($date !== null && !empty($date)) {
            return $this->Stores->findCAStore($date);
        } else {
            return [
                'status' => 1,
                'message' => 'Date null ou undefined',
            ];
        }
    }
}
