<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_staff;
use App\Models\DAO\Dao_store;
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
        $queryStaff = DB::select(
            "SELECT sta.staff_id, 
            sta.first_name, 
            sta.last_name, 
            sta.email, 
            sta.phone, 
            sta.active, 
            sta.store_id, 
            sta.manager_id
            FROM sales.staffs sta",
        );

        $results = [];

        foreach ($queryStaff as $value) {
            $staff = new Dao_staff(
                $value->staff_id,
                $value->first_name,
                $value->last_name,
                $value->email,
                $value->phone,
                $value->active,
                $value->store_id,
                $value->manager_id
            );
            $queryStore = DB::select(
                "SELECT sto.store_id,
                sto.store_name, 
                sto.phone,
                sto.email,
                sto.street,
                sto.city,
                sto.state,
                sto.zip_code
                FROM sales.stores sto
                WHERE sto.store_id = ?",
                [$staff->getStaffStoreId()]
            );
            // $queryManager = DB::select(
            //     "SELECT sta.staff_id, 
            //     sta.first_name, 
            //     sta.last_name, 
            //     sta.email, 
            //     sta.phone, 
            //     sta.active, 
            //     sta.store_id, 
            //     sta.manager_id
            //     FROM sales.staffs sta
            //     WHERE sta.staff_id = ?",
            //     [$staff->getStaffManagerId()]
            // );
            // var_dump($staff->getStaffManagerId());
            foreach ($queryStore as $value) {
                $store = new Dao_store(
                    $value->store_id,
                    $value->store_name,
                    $value->phone,
                    $value->email,
                    $value->street,
                    $value->city,
                    $value->state,
                    $value->zip_code,
                );
                $staff->setStaffStore($store);
            }
            // var_dump($queryManager);
            // foreach ($queryManager as $value) {
            //     $manager = new Dao_staff(
            //         $value->staff_id,
            //         $value->first_name,
            //         $value->last_name,
            //         $value->email,
            //         $value->phone,
            //         $value->active,
            //         $value->store_id,
            //         $value->manager_id
            //     );
            //     // var_dump($manager);
            //     $staff->setStaffManager($manager);
            // }
            array_push($results, $staff);
        }
        return $results;
    }

    function findIt($id)
    {
        try {
            $queryStaff = DB::select(
                "SELECT sta.staff_id, 
                sta.first_name, 
                sta.last_name, 
                sta.email, 
                sta.phone, 
                sta.active, 
                sta.store_id, 
                sta.manager_id
                FROM sales.staffs sta
                WHERE sta.staff_id = ?",
                [$id]
            );

            foreach ($queryStaff as $value) {
                $staff = new Dao_staff(
                    $value->staff_id,
                    $value->first_name,
                    $value->last_name,
                    $value->email,
                    $value->phone,
                    $value->active,
                    $value->store_id,
                    $value->manager_id
                );
                // var_dump($staff);
                $queryStore = DB::select(
                    "SELECT sto.store_id,
                    sto.store_name, 
                    sto.phone,
                    sto.email,
                    sto.street,
                    sto.city,
                    sto.state,
                    sto.zip_code
                    FROM sales.stores sto
                    WHERE sto.store_id = ?",
                    [$staff->getStaffStoreId()]
                );
                $queryManager = DB::select(
                    "SELECT sta.staff_id, 
                    sta.first_name, 
                    sta.last_name, 
                    sta.email, 
                    sta.phone, 
                    sta.active, 
                    sta.store_id, 
                    sta.manager_id
                    FROM sales.staffs sta
                    WHERE sta.staff_id = ?",
                    [$staff->getStaffManagerId()]
                );
                foreach ($queryStore as $value) {
                    $store = new Dao_store(
                        $value->store_id,
                        $value->store_name,
                        $value->phone,
                        $value->email,
                        $value->street,
                        $value->city,
                        $value->state,
                        $value->zip_code,
                    );
                    $staff->setStaffStore($store);
                }
                foreach ($queryManager as $value) {
                    $manager = new Dao_staff(
                        $value->staff_id,
                        $value->first_name,
                        $value->last_name,
                        $value->email,
                        $value->phone,
                        $value->active,
                        $value->store_id,
                        $value->manager_id
                    );
                    $staff->setStaffManager($manager);
                }
                $results = $staff;
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
                'DELETE FROM sales.staffs WHERE staff_id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }

    function top_staffs($date)
    {
        try {
            $query = DB::select('SELECT * FROM sales.best_staff_year(\'' . $date . '\')');

            $result = [];
            foreach ($query as $value) {
                array_push($result, $value);
            }
            return $result;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
