<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Employe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Conge as ModelsConge;

class Conge extends Component
{
    use WithPagination;

    public $birth_name;
    public $conge_id;
    public $start_date;
    public $end_date;
     public $Type;
    public $type;
    public $status;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => '$refresh'
    ];
    // Add more properties as needed

    public function render()
    {
        $conges = ModelsConge::with('conge', 'employe')->paginate(5);
        $employes = \App\Models\Employe::all();

        return view('livewire.conge', [
            'conges' => $conges,
            'employes'=>$employes,
        ]);
}
public function addConge()
    {
        $this->form = 'addConge'; 
    }
    public function resetAll()
    {
        $this->birth_name = '';
        $this->conge_id = '';
        $this->type= '';
        $this->status= '';
        $this->start_date = '';
        $this->end_date = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public $statusOptions = ['pending', 'approved', 'rejected'];

    // other properties and methods...

    public function updateStatus($conge_id, $status)
    {
        $conge = Conge::find($conge_id);
        if ($conge && in_array($status, $this->statusOptions)) {
            $conge->update(['status' => $status]);
            $this->emit('success', 'Status updated successfully.');
        }
    }
    public function storeConge()
    {
        $this->loading = true;
        $this->validate([
            'birth_name' => 'exists:employes,birth_name',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);
    
        
        Conge::create([
            'birth_name' => $this->birth_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'type' => $this->type,
            'status' => $this->status,
        ]);
    
       
        $this->resetAll();
        $this->emit('success'); 
        $this->loading = false;
    }
    

    public function showEdit($conge_id)
{
    $conge = Conge::find($conge_id);
    if ($conge) {
        $this->form = 'editConge';
        $this->confirmingUpdate = true;
        $this->conge_id = $conge_id;
        $this->birth_name = $conge->birth_name;
        $this->start_date = $conge->start_date;
        $this->end_date = $conge->end_date;
        $this->type = $conge->type;
        $this->status = $conge->status;
    }
}


public function updateConge()
{
    $this->loading = true;
    $this->validate([
        'birth_name' => 'required|exists:employees,birth_name',
        'start_date' => 'required',
        'end_date' => 'required',
        'type' => 'required',
        'status' =>'required',
    ]);

    // Find the existing "conge" record in the database based on the conge_id
    $conge = Conge::find($this->conge_id);

    // Check if the "conge" record exists
    if ($conge) {
        // Update the properties of the "conge" record with the updated values
        $conge->update([
            'birth_name' => $this->birth_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        $this->resetAll();
        $this->emit('success'); 
    }

    $this->loading = false;
}


public function deleteCongeConfirmation($conge_id)
{
    $this->confirmingDelete = true;
    $this->conge_id = $conge_id;
}


public function deleteConge()
{
    $this->loading = true;

    $conge = Conge::find($this->conge_id);

   
    if ($conge) {
        $conge->delete();
        $this->resetAll();
        $this->emit('success'); 
        $this->confirmingDelete = false; 
    }
 $this->loading = false;
}

    public function cancel()
    {
        $this->resetAll();
    }
}
