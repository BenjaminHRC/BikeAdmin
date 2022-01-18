<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_role extends Model
{
    private $role_id = null;
    private $code = null;
    private $name = null;

    function __construct($role_id, $code, $name)
    {
        $this->role_id = $role_id;
        $this->code = $code;
        $this->name = $name;
    }

    function getRoleId()
    {
        return $this->role_id;
    }

    function setRoleId($role_id)
    {
        return $this->role_id = $role_id;
    }

    function getRoleName()
    {
        return $this->name;
    }

    function setRoleName($name)
    {
        return $this->name = $name;
    }

    function getRoleCode()
    {
        return $this->code;
    }

    function setRoleCode($code)
    {
        return $this->code = $code;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'role_id' => $this->role_id,
            'code' => $this->code,
            'name' => $this->name,
        ]);
    }
}
