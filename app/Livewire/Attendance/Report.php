<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\ClassRoom;
use App\Models\Student;

class Report extends Component
{
    public $classId = '';
    public $startDate;
    public $endDate;
    public $search = '';

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->endDate = now()->toDateString();
    }

    // public function render()
    // {
    //     $students = Student::with('attendanceDetails')
    //         ->when($this->classId, function ($query) {
    //             $query->where('class_id', $this->classId);
    //         })
    //         ->get();

    //     return view('livewire.attendance.report', [
            // 'classrooms' => ClassRoom::orderBy('class_name')->get(),
    //         'students' => $students,
    //     ]);
    // }
    public function render()
    {
        $students = Student::with([
            'attendanceDetails'
            => function ($query) {

                $query->whereHas(
                    'attendance',
                    function ($q) {

                        $q->whereBetween(
                            'date',
                            [
                                $this->startDate,
                                $this->endDate
                            ]
                        );
                    }
                );
            }
        ])


            ->when(
                $this->classId,
                function ($query) {

                    $query->where(
                        'class_id',
                        $this->classId
                    );
                }
            )


            ->when(
                $this->search,
                function ($query) {

                    $query->where(function ($q) {

                        $q->where(
                            'name',
                            'like',
                            '%' . $this->search . '%'
                        )

                            ->orWhere(
                                'nis',
                                'like',
                                '%' . $this->search . '%'
                            );
                    });
                }
            )->get();
        return view('livewire.attendance.report', [

            'students' => $students,
            'classrooms' => ClassRoom::orderBy('class_name')->get(),


        ]);
    }
}
