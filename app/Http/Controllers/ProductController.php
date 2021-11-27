<?php

namespace App\Http\Controllers;

use App\Models\MODEL\Model_product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $Products;

    function __construct()
    {
        $this->Products = new Model_product();
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
}