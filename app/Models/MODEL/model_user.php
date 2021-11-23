<?php

namespace App\Models\MODEL;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\DAO\dao_user;

class Model_user extends Model
{

    function liste()
    {
        $results = DB::select('SELECT id, name, email FROM dbo.users');

        $listUser = array();

        foreach ($results as $value) {
            $user = new Dao_user($value->id, $value->name, $value->email, null);
            // $user->setToto($value->toto);
            array_push($listUser, $user);
        }
        return $listUser;
    }

    function _save($user)
    {
        DB::insert('INSERT INTO dbo.users (name,email, password) values (?, ?, ?)', [
            $user->getName(),
            $user->getEmail(),
            $user->getPassword()
        ]);

        $rowid = DB::getPdo()->lastInsertId();
        $user->setId($rowid);

        return $user;
    }

    function view($id)
    {
        $request = DB::select('SELECT id, name, email FROM dbo.users where id = ? ', [$id]);

        return $request;
    }

    function drop($id)
    {
        $request = DB::delete('DELETE FROM dbo.users WHERE id = ?', [$id]);
        
        return $request;
    }

    function checkAuth($email, $password)
    {
        $request = DB::select('SELECT id, name, email, password FROM dbo.users WHERE email = ? AND password = ?', [$email, $password]);
        
        
        return $request;
    }
}