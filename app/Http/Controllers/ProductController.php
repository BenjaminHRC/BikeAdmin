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
        // dd($request);
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
            $result = ['status' => 0, 'message' => 'Données sauvegarder'];
        } else {
            $result = ['status' => 1, 'message' => 'Données non sauvegarder'];
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