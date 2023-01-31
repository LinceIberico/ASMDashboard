<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'cart_id',
    ];

    //RELACIONES
    public function product(){
        return $this->belongsToMany(Product::class);
    }

    public function cart(){
        return $this->belongsToMany(Cart::class);
    }
}
