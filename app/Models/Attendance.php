<?php

namespace App\Models;

use App\Models\AttendanceDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceFactory> */
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'schedule_id',
        'teacher_id',
        'user',
        'date',
    ];

    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function details()
    {
        return $this->hasMany(AttendanceDetail::class);
    }
}
