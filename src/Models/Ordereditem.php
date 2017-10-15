<?php

namespace Decoweb\Panelpack\Models;

use Illuminate\Database\Eloquent\Model;

class Ordereditem extends Model
{
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('Decoweb\Panelpack\Models\Orders');
    }

}
