<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Model_staff extends Model
{
    function createIt($staff)
    {
        try {
            DB::insert(
                'INSERT INTO sales.staffs (first_name, last_name, email, phone, active, store_id, manager_id) values (?, ?, ?, ?, ?, ?, ?)',
                [
                    $staff->getStaffFirstName(),
                    $staff->getStaffLastName(),
                    $staff->getStaffEmail(),
                    $staff->getStaffEmail(),
                    $staff->getStaffActive(),
                    $staff->getStaffStoreId(),
                    $staff->getStaffManagerId()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($staff)
    {
        try {
            DB::update(
                'UPDATE sales.staffs set first_name = ?, last_name = ?, email = ?, phone = ?, active = ?, store_id = ?, manager_id WHERE staff_id = ?',
                [
                    $staff->getStaffFirstName(),
                    $staff->getStaffLastName(),
                    $staff->getStaffEmail(),
                    $staff->getStaffEmail(),
                    $staff->getStaffActive(),
                    $staff->getStaffStoreId(),
                    $staff->getStaffManagerId(),
                    $staff->getStaffId()
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
            "SELECT sta.staff_id, sta.first_name, sta.last_name, sta.email, sta.phone, sta.active, sto.store_name, CONCAT(sta1.first_name, ' ' ,sta1.last_name) as manager_id
            FROM sales.staffs sta
            LEFT JOIN sales.stores sto ON sto.store_id = sta.store_id
            LEFT JOIN sales.staffs sta1 ON sta1.staff_id = sta.manager_id",
        );

        $results = [];

        foreach ($query as $value) {
            $staff = new Dao_staff(
                $value->staff_id,
                $value->first_name,
                $value->last_name,
                $value->email,
                $value->phone,
                $value->active,
                $value->store_name,
                $value->manager_id
            );
            array_push($results, $staff);
        }

        return $results;
    }

    function findIt($id)
    {
        try {
            $result = DB::select(
                'SELECT staff_id, first_name, last_name, email, phone, active, store_id, manager_id FROM sales.staffs WHERE staff_id = ?',
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
                'DELETE FROM sales.staffs WHERE staff_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}