<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\AttendanceDetail;
use Carbon\Carbon;


class Dashboard extends Component
{

    public function render()
    {

        return view('livewire.dashboard',[

            'totalStudent'
                => Student::count(),

            'totalTeacher'
                => User::role('Guru')->count(),

            'totalClass'
                => ClassRoom::count(),


            'presentToday'
                => AttendanceDetail::where(
                    'status',
                    'Hadir'
                )
                ->whereDate(
                    'created_at',
                    Carbon::today()
                )
                ->count(),

        ])->layout('layouts.app');

    }

}
