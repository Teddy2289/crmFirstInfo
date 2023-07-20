<?php

namespace App\Http\Livewire;

use App\Models\Technology as ModelsTechnology;
use Livewire\Component;
use Livewire\WithPagination;

class Technology extends Component
{

    use WithPagination;

    public $name, $description;
    public $technologyId;
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
        $technologies = ModelsTechnology::paginate(3);
        return view('livewire.technology', [
            'technologies' => $technologies
        ]);
    }

    public function addTechnology()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addTechnology';
    }

    public function storeTechnology()
    {
        $this->validate(['name' => 'required',
            'description' => 'required',]);


        ModelsTechnology::create([
            'name' => $this->name,
            'description' => $this->description,

        ]);

        $this->resetAll();
        $this->emit('success');
    }

    public function showEdit($technology_id)
    {
        $technology = ModelsTechnology::find($technology_id);
        if ($technology) {
            $this->form = 'editTechnology';
            $this->confirmingUpdate = true;
            $this->technologyId = $technology_id;
            $this->name = $technology->name;
            $this->description = $technology->description;
        }
    }

    public function updateTechnologyConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $technology = ModelsTechnology::find($this->technologyId);
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


    public function deleteTechnologyConfirmed()
    {
        $technology = ModelsTechnology::find($this->technologyId);
        if ($technology) {
            $technology->delete();
            $this->resetAll();
            $this->emit('success');
        }
    }

    public function deleteTechnologyConfirmation($technology_id)
    {
        $this->technologyId = $technology_id;
        $this->confirmingDelete = true;
    }

    public function deleteTechnology()
    {
        $technology = ModelsTechnology::find($this->technologyId);
        if ($technology) {
            $technology->delete();
            $this->resetAll();
            $this->emit('success');
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

        $this->confirmingDelete = false;
    }
}
