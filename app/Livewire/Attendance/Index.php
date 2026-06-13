<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use App\Models\Schedule;
use App\Models\Subject;

class Index extends Component
{
    public $classId;
    public $date;
    public $subjectId;
    public $scheduleId;
    public $search = '';

    public $students = [];
    public $attendanceData = [];

    public function mount()
    {
        $this->date = now()->toDateString();
    }

    // public function updatedClassId()
    // {
    //     $this->loadAttendance();
    // }

    public function updatedDate()
    {
        $this->loadAttendance();
    }

    public function loadAttendance()
    {
        if (!$this->scheduleId) {
            return;
        }

        $students = Student::where(
            'class_id',
            $this->classId
        )->get();

        $this->students = $students;

        $this->attendanceData = [];

        // default semua hadir
        foreach ($students as $student) {
            $this->attendanceData[$student->id] = [
                'status' => 'Hadir',
                'note' => '',
            ];
        }

        // ini buat nampili absensi jika absesnya sudah ada
        // $attendance = Attendance::with('details')
        //     ->where('class_id', $this->classId)
        //     ->where('date', $this->date)
        //     ->first();
        $attendance = Attendance::with('details')
            ->where('class_id', $this->classId)
            ->where('subject_id', $this->subjectId)
            ->where('schedule_id', $this->scheduleId)
            ->where('date', $this->date)
            ->first();

        if (!$attendance) {
            return;
        }


        foreach ($attendance->details as $detail) {

            $this->attendanceData[$detail->student_id] = [
                'status' => $detail->status,
                'note' => $detail->note,
            ];
        }
    }

    public function markAllPresent()
    {
        foreach ($this->students as $student) {

            $this->attendanceData[$student->id] = [
                'status' => 'Hadir',
                'note' => '',
            ];
        }
    }

    public function save()
    {
        $this->validate([
            'scheduleId' => 'required|exists:schedules,id',
            'date' => 'required|date',
        ]);

        $attendance = Attendance::updateOrCreate(
            [
                'class_id' => $this->classId,
                'subject_id' => $this->subjectId,
                'schedule_id' => $this->scheduleId,
                'date' => $this->date,
            ],
            [
                'user' => auth()->id(),
            ]
        );

        foreach ($this->attendanceData as $studentId => $data) {

            AttendanceDetail::updateOrCreate(
                [
                    'attendance_id' => $attendance->id,
                    'student_id' => $studentId,
                ],
                [
                    'status' => $data['status'],
                    'note' => $data['note'] ?? '',
                ]
            );
        }

        session()->flash(
            'success',
            'Absensi berhasil disimpan.'
        );
    }

    public function render()
    {
        $students = Student::query()
            ->when($this->classId, function ($query) {
                $query->where('class_id', $this->classId);
            })
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('nis', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('name')
            ->get();

        $this->students = $students;

        return view('livewire.attendance.index', [
            'classrooms' => ClassRoom::orderBy('class_name')->get(),
            'subjects' => Subject::orderBy('subject_name')->get(),
            // 'schedules' => Schedule::orderBy('subject_id')->get(),
            'schedules' => Schedule::with([
                'classroom',
                'subject'
            ])
                ->where('user_id', auth()->id())
                ->get(),
            'students' => $students,
        ]);
    }

    public function updatedScheduleId()
    {
        if (!$this->scheduleId) {
            return;
        }

        // $schedule = Schedule::find($this->scheduleId);
        $schedule = Schedule::find($this->scheduleId);

        if (!$schedule) {
            return;
        }

        $this->classId = $schedule->class_id;
        $this->subjectId = $schedule->subject_id;

        $this->loadAttendance();
    }
}
