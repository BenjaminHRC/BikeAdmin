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
        $queryBrand = DB::select(
            'SELECT b.brand_id, b.brand_name FROM production.brands b',
        );
        $results = [];
        foreach ($queryBrand as $value) {
            $brand = new Dao_brand(
                $value->brand_id,
                $value->brand_name
            );
            $results[] = $brand;
        }
        return $results;
    }

    function findIt($id)
    {
        try {
            $queryBrand = DB::select(
                'SELECT b.brand_id, b.brand_name FROM production.brands b WHERE brand_id = ?',
                [$id]
            );
            foreach ($queryBrand as $value) {
                $brand = new Dao_brand(
                    $value->brand_id,
                    $value->brand_name
                );
                $results = $brand;
            }
            return $results;
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

    function top_brands()
    {
        try {
            $query = DB::select(
                'SELECT * FROM production.view_top_brand'
            );
            return $query;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
