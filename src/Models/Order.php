<?php

namespace Decoweb\Panelpack\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items()
    {
        return $this->hasMany('Decoweb\Panelpack\Models\Ordereditem');
    }

    public function customer()
    {
        return $this->belongsTo('Decoweb\Panelpack\Models\Customer');
    }

    public function transport()
    {
        return $this->belongsTo('Decoweb\Panelpack\Models\Transport');
    }

    public function status()
    {
        return $this->belongsTo('Decoweb\Panelpack\Models\Status');
    }

    public function proforma()
    {
        return $this->hasOne('Decoweb\Panelpack\Models\Proforma');
    }

    /**
     * @return mixed|string
     */
    public function customerName()
    {
        if( $this->account_type == 0 && trim($this->name) != '' ){
            return $this->name;
        }
        if( $this->account_type == 1 && trim($this->company) != '' ){
            return $this->company;
        }

        return 'Unidentified customer';
    }

    public function finalPrice()
    {
        return number_format($this->price + $this->price_transport,2);
    }
}
