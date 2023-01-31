<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'dni',
        'name',
        'surname',
        'phone',
        'first_address',
        'second_address',
        'city',
        'postal_code',
        'country',
    ];

    protected $hidden = [
        'user_id',
    ];

    //RELACIONES
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function clientAppointment(){
        return $this->hasMany(ClientAppointment::class);
    }

    public function clientInvoice(){
        return $this->hasMany(ClientInvoice::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }
}
