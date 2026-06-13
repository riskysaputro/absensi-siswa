<?php

use App\Http\Controllers\AttendanceReportController;
use App\Http\Controllers\ProfileController;

use App\Livewire\Attendance\Index as AttendanceIndex;
use App\Livewire\Attendance\Report;

use App\Livewire\Classroom\Index as ClassroomIndex;
use App\Livewire\Dashboard;

use App\Livewire\Permission\Assign;
use App\Livewire\Permission\Index as PermissionIndex;

use App\Livewire\Schedule\Index as ScheduleIndex;
use App\Livewire\Student\Index as StudentIndex;
use App\Livewire\Subject\Index as SubjectIndex;
use App\Livewire\User\Index as UserIndex;

use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', Dashboard::class)
        ->name('dashboard');


    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');




    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])
    ->name('profile.edit');


    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])
    ->name('profile.update');


    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])
    ->name('profile.destroy');





    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */


    Route::get('/users', UserIndex::class)
        ->middleware('permission:manage users')
        ->name('users.index');



    Route::get('/classrooms', ClassroomIndex::class)
        ->middleware('permission:manage classes')
        ->name('classrooms.index');



    Route::get('/students', StudentIndex::class)
        ->middleware('permission:manage students')
        ->name('students.index');



    Route::get('/subject', SubjectIndex::class)
        ->middleware('permission:manage subjects')
        ->name('subject.index');



    Route::get('/schedule', ScheduleIndex::class)
        ->middleware('permission:manage schedules')
        ->name('schedule.index');






    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */


    Route::get('/attendances', AttendanceIndex::class)
        ->middleware('permission:take attendance')
        ->name('attendance.index');



    Route::get('/report', Report::class)
        ->middleware('permission:view reports')
        ->name('attendance.report');



    Route::get(
        '/attendance/report/pdf',
        [AttendanceReportController::class,'download']
    )
    ->middleware('permission:view reports')
    ->name('attendance.report.pdf');






    /*
    |--------------------------------------------------------------------------
    | Permission Management
    |--------------------------------------------------------------------------
    */


    Route::middleware('role:Super Admin')
        ->group(function(){


            Route::get(
                '/permissions',
                PermissionIndex::class
            )
            ->name('permissions.index');



            Route::get(
                '/permissions/assign',
                Assign::class
            )
            ->name('permission.assign');


        });



});



require __DIR__.'/auth.php';
