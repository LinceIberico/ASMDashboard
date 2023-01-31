<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_category_id',
        'label',
        'high',
        'width',
        'size',
        'color',
        'description',
        'price',
        'discount',
        'quantity',
        'available',
    ];

    //RELACIONES
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function cartProduct(){
        return $this->hasMany(CartProduct::class);
    }

    public function productCategory(){
        return $this->hasOne(ProductCategory::class);
    }
}
