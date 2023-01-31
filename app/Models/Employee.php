<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'dni',
        'name',
        'surname',
        'phone_1',
        'phone_2',
        'address_1',
        'address_2',
        'city',
        'postal_code',
        'country',
        'status',
        'start_holydays',
        'user_id',
        'workdays_id',
    ];

    public function user(){
        return $this->belongsTo(User::client);
    }

    // public function workday(){
    //     return $this->hasOne(Workday::class);
    // }

    public function employeeWorkday(){
        return $this->hasMany(EmployeeWorday::class);
    }
}
