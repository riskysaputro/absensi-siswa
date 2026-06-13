<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $subjectId;
    public $subject_name;
    public $description;

    public $search = '';
    public $showModal = false;

    protected $rules = [
        'subject_name' => 'required|min:3',
        'description' => 'nullable|string',
    ];
    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        Subject::create([
            'subject_name' => $this->subject_name,
            'description' => $this->description,
        ]);

        $this->showModal = false;
        $this->resetForm();

        session()->flash(
            'success',
            'Mata pelajaran berhasil ditambahkan.'
        );
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);

        $this->subjectId = $subject->id;
        $this->subject_name = $subject->subject_name;
        $this->description = $subject->description;

        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        Subject::findOrFail($this->subjectId)
            ->update([
                'subject_name' => $this->subject_name,
                'description' => $this->description,
            ]);
        $this->showModal = false;

        $this->resetForm();

        session()->flash(
            'success',
            'Mata pelajaran berhasil diupdate.'
        );
    }

    public function delete($id)
    {
        Subject::findOrFail($id)->delete();

        session()->flash(
            'success',
            'Mata pelajaran berhasil dihapus.'
        );
    }

    public function resetForm()
    {
        $this->reset([
            'subjectId',
            'subject_name',
            'description',
        ]);
    }

    public function render()
    {
        return view('livewire.subject.index', [
            'subjects' => Subject::query()
                ->when($this->search, function ($query) {
                    $query->where(
                        'subject_name',
                        'like',
                        '%' . $this->search . '%'
                    );
                })
                ->latest()
                ->paginate(10),
        ])->layout('layouts.app');
    }
}
