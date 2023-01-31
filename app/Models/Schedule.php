<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'schedule',
        'available',
    ];

    //RELACIONES
    public function appointmentSchedule(){
        return $this->hasMany(AppointmentSchedule::class);
    }
}
