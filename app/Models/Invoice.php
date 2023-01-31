<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'identifier',
        'client_invoice_id',
        'invoice_product_id',
        // 'cart_product_id',
        'cart_id',
        'payment_id',
        'iva',
        'total',
        'status',
    ];

    //RELACIONES
    public function clientInvoice(){
        return $this->hasMany(ClientInvoice::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function invoiceProduct(){
        return $this->hasMany(InvoiceProduct::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
