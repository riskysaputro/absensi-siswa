<?php

namespace App\Livewire\Classroom;

use App\Models\ClassRoom;
use Livewire\Component;

class Index extends Component
{
    public $class_name;
    public $classroomId;
    public $showModal = false;
    public $isEdit = false;

    public $showCreateModal = false;
    public $showEditModal = false;

    protected $rules = [
        'class_name' => 'required'
    ];

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }



    public function openEdit($id)
    {
        $classroom = ClassRoom::findOrFail($id);


        $this->classroomId = $classroom->id;

        $this->class_name = $classroom->class_name;


        $this->showEditModal = true;
    }

    public function closeEdit()
    {
        $this->showEditModal = false;

        $this->resetForm();
    }
    public function resetForm()
    {
        $this->reset([
            'classroomId',
            'class_name'
        ]);
    }


    public function cancel()
    {
        $this->resetForm();
    }

    public function store()
    {
        $this->validate();


        ClassRoom::create([
            'class_name' => $this->class_name
        ]);
        $this->showModal = false;
        $this->resetForm();


        session()->flash(
            'success',
            'Kelas berhasil ditambahkan'
        );


        // $this->closeCreate();
    }

    public function edit($id)
    {
        $classroom = ClassRoom::findOrFail($id);

        $this->classroomId = $classroom->id;
        $this->class_name = $classroom->class_name;

        $this->showModal = true;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();


        ClassRoom::findOrFail($this->classroomId)
            ->update([
                'class_name' => $this->class_name
            ]);


        session()->flash(
            'success',
            'Kelas berhasil diupdate'
        );


        $this->closeEdit();
    }

    public function delete($id)
    {
        ClassRoom::findOrFail($id)->delete();

        session()->flash('success', 'Kelas berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.classroom.index', [
            'classrooms' => ClassRoom::latest()->get()
        ])->layout('layouts.app-dashboard');
    }
}