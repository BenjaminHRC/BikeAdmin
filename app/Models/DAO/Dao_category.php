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

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        return $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function setName($name)
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