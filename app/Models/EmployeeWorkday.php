<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeWorkday extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'workday_id',
    ];

    public function employee(){
        return $this->belongsToMany(Employee::class);
    }

    public function workday(){
        return $this->belongsToMany(Workday::class);
    }
}
