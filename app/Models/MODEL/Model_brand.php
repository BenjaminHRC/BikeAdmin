<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_brand extends Model
{
    function createIt($brand)
    {
        try {
            DB::insert(
                'INSERT INTO production.brands (brand_name) values (?)',
                [
                    $brand->getBrandName(),
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($brand)
    {
        try {
            DB::update(
                'UPDATE production.brands set brand_name = ? WHERE brand_id = ?',
                [
                    $brand->getBrandName(),
                    $brand->getBrandId()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function findAll()
    {
        $query = DB::select(
            'SELECT brand_id, brand_name FROM production.brands',
        );

        $results = [];

        foreach ($query as $value) {
            $brand = new Dao_brand(
                $value->brand_id,
                $value->brand_name
            );
            array_push($results, $brand);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $result = DB::select(
                'SELECT brand_id, brand_name FROM production.brands WHERE brand_id = ?',
                [$id]
            );
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function dropIt($id)
    {
        try {
            DB::delete(
                'DELETE FROM production.brands WHERE brand_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}