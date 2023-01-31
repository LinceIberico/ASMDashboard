<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'day',
        'comment',
        'schedule_id',
        'product_id',
    ];

    //RELACIONES
    public function clientAppointment(){
        return $this->hasMany(ClientAppointment::class);
    }

    public function appointmentSchedule(){
        return $this->hasMany(AppointmentSchedule::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
