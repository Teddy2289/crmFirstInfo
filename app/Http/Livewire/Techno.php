<?php

namespace App\Http\Livewire;

use App\Models\Techno;
use Livewire\Component;
use Livewire\WithPagination;

class TechnologyComponent extends Component
{
    use WithPagination;

    public $name;
    public $technologyId;
    public $description;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => '$refresh'
    ];

    public function render()
    {
        $technologies = Techno::paginate(5);

        return view('livewire.technology-component', [
            'technologies' => $technologies,
        ]);
    }

    public function addTechnology()
    {
        $this->form = 'addTechnology';
    }

    public function storeTechnology()
    {
        $this->loading = true;
        $this->validate([
            'name' => 'required',
            'description'=>'required'
        ]);

        Techno::create([
            'name' => $this->name,
            'description' =>$this->description,
        ]);

        $this->resetAll();
        $this->emit('success');
        $this->loading = false;
    }

    public function deleteTechnologyConfirmation($technologyId)
    {
        $this->technologyId = $technologyId;
        $this->confirmingDelete = true;
    }

    public function deleteTechnologyConfirmed()
    {
        $this->loading = true;
        $technology = Techno::find($this->technologyId);
        if ($technology) {
            $technology->delete();
            $this->resetAll();
            $this->emit('success');
            $this->dispatchBrowserEvent('close-delete-confirmation-modal');
            $this->loading = false;
        }
    }

    public function showEdit($technologyId)
    {
        $technology = Techno::find($technologyId);
        if ($technology) {
            $this->form = 'editTechnology';
            $this->confirmingUpdate = true;
            $this->technologyId = $technologyId;
            $this->name = $technology->name;
            $this->description = $technology->description;
        }
    }

    public function updateTechnologyConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $technology = Techno::find($this->technologyId);
            if ($technology) {
                $technology->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);
                $this->resetAll();
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->name = '';
        $this->description = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }
}
