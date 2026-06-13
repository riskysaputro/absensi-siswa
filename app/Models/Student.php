<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    protected $table = 'students';

    protected $fillable = [
        'class_id',
        'nis',
        'name',
        'gender',
        'phone',
        'address',
        'note',
    ];
    
    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
    public function attendanceDetails()
    {
        return $this->hasMany(AttendanceDetail::class);
    }
}
