<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function manufacturers()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'id', );
    }

}
