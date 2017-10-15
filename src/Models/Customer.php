<?php

namespace Decoweb\Panelpack\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomerResetPassword;
class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company', 'email', 'password', 'email_token', 'verified', 'provider', 'provider_id',
        'account_type', 'phone', 'cnp', 'region', 'city', 'address', 'rc', 'cif', 'bank_account', 'bank_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPassword($token, $this->name));
    }

    public function orders()
    {
        return $this->hasMany('Decoweb\Panelpack\Models\Order');
    }
}