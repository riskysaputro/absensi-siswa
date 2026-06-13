<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    /** @use HasFactory<\Database\Factories\ClassRoomFactory> */
    use HasFactory;

    protected $table = 'class_rooms';

    protected $fillable = [
        'class_name',
        'homeroom_user_id',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function homeroomUser()
    {
        return $this->belongsTo(
            User::class,
            'homeroom_user_id'
        );
    }
}