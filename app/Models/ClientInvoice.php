<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'invoice_id',
    ];

    public function client(){
        return $this->belogsToMany(Client::class);
    }

    public function invoice(){
        return $this->belogsToMany(Invoice::class);
    }
}
