<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_category;
use App\Models\MODEL\Model_category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $Categories;

    function __construct()
    {
        $this->Categories = new Model_category();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Categories->findIt($id);
        } else {
            return ["status" => 1, "message" => "ID null ou undefined"];
        }
    }

    function list()
    {
        $query = $this->Categories->findAll();

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

        if ($request->category_id != null && !empty($request->category_id)) {
            $categories = new Dao_category(
                $request->category_id,
                $request->category_name
            );
            // dd($this->Products->createIt($products));
            if ($this->Categories->updateIt($categories) === true) {
                $result = ['status' => 0, "action" => "update", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "update", 'message' => 'Données non sauvegarder', 'error' => $this->Categories->updateIt($categories)];
            }
        } else {
            $categories = new Dao_category(
                null,
                $request->category_name
            );
            // dd($this->Products->createIt($products));
            if ($this->Categories->createIt($categories) === true) {
                $result = ['status' => 0, "action" => "create", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "create", 'message' => 'Données non sauvegarder', 'error' => $this->Categories->createIt($categories)];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ["status" => 2, "message" => "Données non formatée"];

        if ($this->Categories->dropIt($id) === true) {
            $results = ["status" => 0, "message" => "Données supprimée"];
        } else {
            $results = ["status" => 1, "message" => "Données non supprimée", "error" => $this->Categories->dropIt($id)];
        }

        return json_encode($results);
    }
}