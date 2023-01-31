<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'appointment_id',
        'schedule_id',
        'product_id',
    ];

    //RELACIONES
    public function schedule(){
        return $this->belongsToMany(Schedule::class);
    }

    public function appointment(){
        return $this->belongsToMany(Appointment::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
