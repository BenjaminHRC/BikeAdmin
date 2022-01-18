<?php

namespace App\Models\MODEL;

use App\Models\DAO\Dao_role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\Dao_user;

class Model_user extends Model
{
    function createIt($user)
    {
        try {
            DB::insert(
                'INSERT INTO dbo.users (name, email, password, role_id) values (?, ?, ?, ?)',
                [
                    $user->getName(),
                    $user->getEmail(),
                    $user->getPassword(),
                    $user->getRoleId()
                ]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function updateIt($user)
    {
        try {
            DB::update(
                'UPDATE dbo.users set name = ?, email = ?, password = ?, role_id = ?
                WHERE id = ?',
                [
                    $user->getName(),
                    $user->getEmail(),
                    $user->getPassword(),
                    $user->getRoleId(),
                    $user->getId(),
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
        $queryUser = DB::select(
            'SELECT id, name, email, role_id
            FROM dbo.users',
        );
        $results = [];
        foreach ($queryUser as $value) {
            $user = new Dao_user(
                $value->id,
                $value->name,
                $value->email,
                null,
                $value->role_id
            );

            if ($user->getRoleId() != null && !empty($user->getRoleId())) {
                // var_dump($user->getRoleId());
                $queryRole = DB::select(
                    'SELECT role_id, code, name 
                FROM dbo.roles 
                WHERE role_id = ?',
                    [$user->getRoleId()]
                );
                foreach ($queryRole as $value) {
                    $role = new Dao_role(
                        $value->role_id,
                        $value->code,
                        $value->name,
                    );
                    $user->setRole($role);
                }
            }
            $results[] = $user;
        }
        return $results;
    }

    function findIt($id)
    {
        try {
            $queryUser = DB::select(
                'SELECT id, name, email, password, role_id
                FROM dbo.users
                WHERE id = ?',
                [$id]
            );

            foreach ($queryUser as  $value) {
                $user  = new Dao_user(
                    $value->id,
                    $value->name,
                    $value->email,
                    $value->password,
                    $value->role_id,
                );
                $results = $user;
            }
            return $results;
        } catch (\Exception $e) {
            $result = $e;
        }
        return $result;
    }

    function findItByEmail($email)
    {
        try {
            $queryUser = DB::select(
                'SELECT id, name, email, role_id
                FROM dbo.users
                WHERE email = ?',
                [$email]
            );

            foreach ($queryUser as  $value) {
                $user  = new Dao_user(
                    $value->id,
                    $value->name,
                    $value->email,
                    null,
                    $value->role_id,
                );
                $results = $user;
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
                'DELETE FROM dbo.users WHERE id = ?',
                [$id]
            );
            $result = true;
        } catch (\Exception $e) {
            $result = $e;
        }

        return $result;
    }
}
