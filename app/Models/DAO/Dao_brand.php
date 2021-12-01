<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_brand extends Model
{
    private $id = null;
    private $name = null;

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    function getBrandId()
    {
        return $this->id;
    }

    function setBrandId($id)
    {
        return $this->id = $id;
    }

    function getBrandName()
    {
        return $this->name;
    }

    function setBrandName($name)
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