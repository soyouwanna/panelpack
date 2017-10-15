<?php

namespace Decoweb\Panelpack\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function table()
    {
        return $this->belongsTo('Decoweb\Panelpack\Models\SysCoreSetup','table_id');
    }
}
