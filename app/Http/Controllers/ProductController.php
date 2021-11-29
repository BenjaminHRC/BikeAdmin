<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_product;
use App\Models\MODEL\Model_product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $Products;

    function __construct()
    {
        $this->Products = new Model_product();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Products->findIt($id);
        } else {
            return ["status" => 1, "message" => "ID null ou undefined"];
        }
    }

    function list()
    {
        $query = $this->Products->findAll();

        $results = array();

        foreach ($query as $value) {
            // $value->setLastName(strtolower($value->getLastName()));
            array_push($results, json_decode($value->toJSONPrivate(), true));
        }

        return json_encode(['data' => $results]);
    }

    function save(Request $request)
    {
        $result = ['status' => 2, 'message' => 'Données non formatée'];

        if ($request->product_id != null && !empty($request->product_id)) {
            $products = new Dao_product(
                $request->product_id,
                $request->product_name,
                $request->model_year,
                $request->list_price,
                $request->brand_id,
                $request->category_id
            );
            // dd($this->Products->createIt($products));
            if ($this->Products->updateIt($products) === true) {
                $result = ['status' => 0, "action" => "update", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "update", 'message' => 'Données non sauvegarder'];
            }
        } else {
            $products = new Dao_product(
                null,
                $request->product_name,
                $request->model_year,
                $request->list_price,
                $request->brand_id,
                $request->category_id
            );
            // dd($this->Products->createIt($products));
            if ($this->Products->createIt($products) === true) {
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

        if ($this->Products->dropIt($id) === true) {
            $results = ["status" => 0, "message" => "Données supprimée"];
        } else {
            $results = ["status" => 1, "message" => "Données non supprimée", "error" => $this->Products->dropIt($id)];
        }

        return json_encode($results);
    }
}