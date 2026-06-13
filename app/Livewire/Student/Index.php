<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Student;
use App\Models\ClassRoom;

class Index extends Component
{
    use WithPagination;

    //property buat di panggil di halaman index.blade.php
    public $studentId;

    public $class_id;
    public $nis;
    public $name;
    public $phone;
    public $gender;
    public $address;
    public $showModal = false;
    //

    public $search = '';

    public $isEdit = false;

    protected function rules()
    {
        return [
            'class_id' => 'required|exists:class_rooms,id',
            'nis' => 'required|max:20|unique:students,nis,' . $this->studentId,
            'name' => 'required|max:255',
            'phone' => 'nullable|max:20',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'address' => 'nullable|max:255',
        ];
    }

    public function render()
    {
        return view('livewire.student.index', [
            'students' => Student::with('classRoom')
                ->when($this->search, function ($query) {
                    $query->where('nis', 'like', '%' . $this->search . '%')
                        ->orWhere('name', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate(10),

            'classrooms' => ClassRoom::orderBy('class_name')->get(),
        ]);
    }

    public function store()
    {
        $this->validate();
        $this->showModal = false;

        Student::create([
            'class_id' => $this->class_id,
            'nis' => $this->nis,
            'name' => $this->name,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Data siswa berhasil ditambahkan');

        $this->resetForm();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
        // dd('jalan');
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        $this->studentId = $student->id;
        $this->class_id = $student->class_id;
        $this->nis = $student->nis;
        $this->name = $student->name;
        $this->phone = $student->phone;
        $this->gender = $student->gender;
        $this->address = $student->address;

        $this->isEdit = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $student = Student::findOrFail($this->studentId);

        $student->update([
            'class_id' => $this->class_id,
            'nis' => $this->nis,
            'name' => $this->name,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Data siswa berhasil diperbarui');

        $this->showModal = false;
        $this->resetForm();
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();

        session()->flash('success', 'Data siswa berhasil dihapus');
    }

    public function cancel()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'studentId',
            'class_id',
            'nis',
            'name',
            'phone',
            'gender',
            'address',
        ]);

        $this->isEdit = false;
    }
}
