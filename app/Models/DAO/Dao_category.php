<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_category extends Model
{
    private $category_id = null;
    private $category_name = null;

    function __construct($category_id, $category_name)
    {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
    }

    function getCategoryId()
    {
        return $this->category_id;
    }

    function setCategoryId($category_id)
    {
        return $this->category_id = $category_id;
    }

    function getCategoryName()
    {
        return $this->category_name;
    }

    function setCategoryName($category_name)
    {
        return $this->category_name = $category_name;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'category_id' => $this->category_id,
            'category_name' => $this->category_name
        ]);
    }
}
