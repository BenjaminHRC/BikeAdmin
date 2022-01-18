<?php

namespace App\Http\Controllers;

use App\Models\DAO\Dao_brand;
use App\Models\MODEL\Model_brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private $Brands;

    function __construct()
    {
        $this->Brands = new Model_brand();
    }

    function index()
    {
    }

    function view($id)
    {
        if ($id != null && !empty($id)) {
            return $this->Brands->findIt($id);
        } else {
            return ["status" => 1, "message" => "ID null ou undefined"];
        }
    }

    function list()
    {
        $query = $this->Brands->findAll();

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

        if ($request->brand_id != null && !empty($request->brand_id)) {
            $brands = new Dao_brand(
                $request->brand_id,
                $request->brand_name
            );
            // dd($this->Products->createIt($products));
            if ($this->Brands->updateIt($brands) === true) {
                $result = ['status' => 0, "action" => "update", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "update", 'message' => 'Données non sauvegarder', 'error' => $this->Brands->updateIt($brands)];
            }
        } else {
            $brands = new Dao_brand(
                null,
                $request->brand_name
            );
            // dd($this->Products->createIt($products));
            if ($this->Brands->createIt($brands) === true) {
                $result = ['status' => 0, "action" => "create", 'message' => 'Données sauvegarder'];
            } else {
                $result = ['status' => 1, "action" => "create", 'message' => 'Données non sauvegarder', 'error' => $this->Brands->createIt($brands)];
            }
        }

        return json_encode($result);
    }

    function delete($id)
    {
        $results = ["status" => 2, "message" => "Données non formatée"];

        if ($this->Brands->dropIt($id) === true) {
            $results = ["status" => 0, "message" => "Données supprimée"];
        } else {
            $results = ["status" => 1, "message" => "Données non supprimée", "error" => $this->Brands->dropIt($id)];
        }

        return json_encode($results);
    }

    function getTopBrands()
    {
        try {
            $query = $this->Brands->top_brands();
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
