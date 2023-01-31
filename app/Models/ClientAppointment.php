<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientAppointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'client_appointment';

    protected $fillable = [
        'client_id',
        'appointment_id',
    ];

    //RELACIONES
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
