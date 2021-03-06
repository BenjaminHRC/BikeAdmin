<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_product;
use App\Models\MODEL\Model_brand;
use App\Models\MODEL\Model_category;
use App\Models\MODEL\Model_product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $Products;
    private $Brands;
    private $Categories;

    function __construct()
    {
        $this->Products = new Model_product();
        $this->Brands = new Model_brand();
        $this->Categories = new Model_category();
    }

    function index()
    {
        $query['brands'] = $this->Brands->findAll();
        $query['categories'] = $this->Categories->findAll();

        $valuesBrands = [];
        $valuesCategories = [];

        foreach ($query['brands'] as $value) {
            array_push($valuesBrands, json_decode($value->toJSONPrivate(), true));
        }
        foreach ($query['categories'] as $value) {
            array_push($valuesCategories, json_decode($value->toJSONPrivate(), true));
        }

        $results['brands'] = $valuesBrands;
        $results['categories'] = $valuesCategories;

        return json_encode($results);
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Products->findIt($id)->toJSONPrivate();
        } else {
            return ["status" => 1, "message" => "ID null ou undefined"];
        }
    }

    function list()
    {
        $query = $this->Products->findAll();
        // var_dump($query);
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

    function getTopProducts()
    {
        try {
            $query = $this->Products->top_products();
            $result = [];
            foreach ($query as $key => $value) {
                array_push($result, $value);
            }
            return json_encode($result);
        } catch (\Exception $e) {
            return $e;
        }
    }

    function getNbProducts()
    {
        try {
            $query = $this->Products->nb_products();
            $result = [];
            foreach ($query as $key => $value) {
                array_push($result, $value);
            }
            return json_encode($result);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
