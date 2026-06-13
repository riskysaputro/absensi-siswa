<?php

namespace App\Livewire\Schedule;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Schedule;
use App\Models\ClassRoom;
use App\Models\Subject;
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public $scheduleId;

    public $class_id;
    public $user_id;
    public $subject_id;
    public $day;
    public $start_time;
    public $end_time;

    protected $paginationTheme = 'tailwind';

    public function resetInput()
    {
        $this->scheduleId = null;
        $this->class_id = '';
        $this->user_id = '';
        $this->subject_id = '';
        $this->day = '';
        $this->start_time = '';
        $this->end_time = '';
    }

    public function store()
    {
        $this->validate([
            'class_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Schedule::create([
            'class_id' => $this->class_id,
            'user_id' => $this->user_id,
            'subject_id' => $this->subject_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        session()->flash('success', 'Jadwal berhasil ditambahkan.');

        $this->resetInput();
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);

        $this->scheduleId = $schedule->id;
        $this->class_id = $schedule->class_id;
        $this->user_id = $schedule->user_id;
        $this->subject_id = $schedule->subject_id;
        $this->day = $schedule->day;
        $this->start_time = $schedule->start_time;
        $this->end_time = $schedule->end_time;
    }

    public function update()
    {
        $this->validate([
            'class_id' => 'required',
            'user_id' => 'required',
            'subject_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Schedule::findOrFail($this->scheduleId)->update([
            'class_id' => $this->class_id,
            'user_id' => $this->user_id,
            'subject_id' => $this->subject_id,
            'day' => $this->day,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        session()->flash('success', 'Jadwal berhasil diupdate.');

        $this->resetInput();
    }

    public function delete($id)
    {
        Schedule::findOrFail($id)->delete();

        session()->flash('success', 'Jadwal berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.schedule.index', [
            'schedules' => Schedule::with([
                'classroom',
                'teacher',
                'subject'
            ])->latest()->paginate(10),

            'classrooms' => ClassRoom::all(),
            'teachers' => User::role('Guru')->get(),
            'subjects' => Subject::all(),
        ]);
    }
}
