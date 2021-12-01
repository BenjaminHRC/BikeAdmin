<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_category extends Model
{
    private $id = null;
    private $name = null;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    function getCategoryId()
    {
        return $this->id;
    }

    function setCategoryId($id)
    {
        return $this->id = $id;
    }

    function getCategoryName()
    {
        return $this->name;
    }

    function setCategoryName($name)
    {
        return $this->name = $name;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name
        ]);
    }
}