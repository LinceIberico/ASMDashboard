<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'invoice_id',
        'total',
        'payment_method',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }
}
