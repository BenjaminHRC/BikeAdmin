<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function save()
    {
        return json_encode(["status" => 0, "message" => "Yep"]);
    }
}
