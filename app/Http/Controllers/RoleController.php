<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_role;
use App\Models\MODEL\Model_role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $Roles;

    function __construct()
    {
        $this->Roles = new Model_role();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Roles->findIt($id)->toJSONPrivate();
        } else {
            return ['status' => 1, 'message' => 'ID null ou undefined'];
        }
    }

    function list()
    {
        $query = $this->Roles->findAll();

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
        if ($request->role_id != null && !empty($request->role_id)) {
            $roles = new Dao_role(
                $request->role_id,
                $request->code,
                $request->name,
            );
            // dd($this->Products->createIt($products));
            if ($this->Roles->updateIt($roles) === true) {
                $result = ['status' => 0, 'action' => 'update', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'update', 'message' => 'Données non sauvegarder', 'error' => $this->Roles->updateIt($roles)];
            }
        } else {
            $roles = new Dao_role(
                null,
                $request->code,
                $request->name,
            );
            // dd($this->Products->createIt($products));
            if ($this->Roles->createIt($roles) === true) {
                $result = ['status' => 0, 'action' => 'create', 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, 'action' => 'create', 'message' => 'Données non sauvegarder', 'error' => $this->Roles->createIt($roles)];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ['status' => 2, 'message' => 'Données non formatée'];

        if ($this->Roles->dropIt($id) === true) {
            $results = ['status' => 0, 'message' => 'Données supprimée'];
        } else {
            $results = ['status' => 1, 'message' => 'Données non supprimée', 'error' => $this->Roles->dropIt($id)];
        }

        return json_encode($results);
    }
}
