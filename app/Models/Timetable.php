<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_periods_id',
        'week',
        'day',
        'period',
        'duration',
        'class',
        'teacher',
        'subject',
        'classroom'
    ];
}
