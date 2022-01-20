<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_category extends Model
{
    function createIt($category)
    {
        try {
            DB::insert(
                'INSERT INTO production.categories (category_name) values (?)',
                [
                    $category->getCategoryName(),
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($category)
    {
        try {
            DB::update(
                'UPDATE production.categories set category_name = ? WHERE category_id = ?',
                [
                    $category->getCategoryName(),
                    $category->getCategoryId()
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
        $queryCategory = DB::select(
            'SELECT c.category_id, c.category_name FROM production.categories c',
        );
        $results = [];
        foreach ($queryCategory as $value) {
            $category = new Dao_category(
                $value->category_id,
                $value->category_name
            );
            $results[] = $category;
        }
        return $results;
    }

    function findIt($id)
    {
        try {
            $queryCategory = DB::select(
                'SELECT c.category_id, c.category_name FROM production.categories c WHERE c.category_id = ?',
                [$id]
            );
            foreach ($queryCategory as $value) {
                $category = new Dao_category(
                    $value->category_id,
                    $value->category_name
                );
                $results = $category;
            }
            return $results;
        } catch (\Exception $e) {
            return $e;
        }
    }

    function dropIt($id)
    {
        try {
            DB::delete(
                'DELETE FROM production.categories WHERE category_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}
