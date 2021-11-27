<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_brand;
use App\Models\DAO\Dao_category;
use App\Models\DAO\Dao_product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Model_product extends Model
{
    function createIt()
    {
    }

    function findAll()
    {
        $query = DB::select('SELECT product_id, product_name, model_year, list_price, brand_id, category_id FROM production.products');

        $results = array();

        foreach ($query as $value) {
            $product = new Dao_product($value->product_id, $value->product_name, $value->model_year, $value->list_price, $value->brand_id, $value->category_id);
            // $user->setToto($value->toto);
            array_push($results, $product);
        }
        return $results;
    }

    function saveIt()
    {
    }

    function dropIt()
    {
    }
}