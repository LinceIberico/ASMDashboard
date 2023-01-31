<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'cart_product_id',
        'invoice',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function cartProduct(){
        return $this->hasMany(CartProduct::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
