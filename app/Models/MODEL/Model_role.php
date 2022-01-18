<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_role extends Model
{
    function createIt($role)
    {
        try {
            DB::insert(
                'INSERT INTO dbo.roles (code, name) values (?, ?)',
                [
                    $role->getRoleCode(),
                    $role->getRoleName(),
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($role)
    {
        try {
            DB::update(
                'UPDATE dbo.roles set code = ?, name = ? WHERE role_id = ?',
                [
                    $role->getRoleCode(),
                    $role->getRoleName(),
                    $role->getRoleId()
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
        try {
            $query = DB::select(
                "SELECT r.role_id, r.code, r.name 
            FROM dbo.roles r",
            );
            $result = [];
            foreach ($query as $value) {
                $role = new Dao_role(
                    $value->role_id,
                    $value->code,
                    $value->name,
                );
                array_push($result, $role);
            }
            return $result;
        } catch (\Exception $e) {
            $result = $e;
        }
    }

    function findIt($id)
    {
        try {
            $query = DB::select(
                'SELECT role_id, code, name FROM dbo.roles WHERE role_id = ?',
                [$id]
            );
            foreach ($query as $value) {
                $role = new Dao_role(
                    $value->role_id,
                    $value->code,
                    $value->name
                );
                $result = $role;
            }
            return $result;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function dropIt($id)
    {
        try {
            DB::delete(
                'DELETE FROM dbo.roles WHERE role_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }
}
