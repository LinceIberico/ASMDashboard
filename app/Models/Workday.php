<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workday extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'description',
        'start_day',
        'end_day',
        'rest',
        'start_date',
        'end_date',
        'workday_category_id',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function workdayCategory(){
        return $this->hasOne(WorkdayCategory::class);
    }

    public function employeeWorkday(){
        return $this->hasMany(EmployeeWorday::class);
    }
}
