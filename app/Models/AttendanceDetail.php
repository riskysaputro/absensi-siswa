<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceDetail extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'student_id',
        'status',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
