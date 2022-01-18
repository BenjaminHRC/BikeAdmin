<?php

namespace App\Models\DAO;

use Illuminate\Database\Eloquent\Model;

class Dao_brand extends Model
{
    private $brand_id = null;
    private $brand_name = null;

    function __construct($brand_id, $brand_name)
    {
        $this->brand_id = $brand_id;
        $this->brand_name = $brand_name;
    }

    function getBrandId()
    {
        return $this->brand_id;
    }

    function setBrandId($brand_id)
    {
        return $this->brand_id = $brand_id;
    }

    function getBrandName()
    {
        return $this->brand_name;
    }

    function setBrandName($brand_name)
    {
        return $this->brand_name = $brand_name;
    }

    public function toJSONPrivate()
    {
        return json_encode([
            'brand_id' => $this->brand_id,
            'brand_name' => $this->brand_name
        ]);
    }
}
