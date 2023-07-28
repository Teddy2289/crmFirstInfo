<?php

namespace App\Http\Livewire;

use App\Models\LeaveType as LeaveTypeModel;
use Livewire\Component;

class LeaveType extends Component
{
    public $libelle;
    public $description;
    public $editMode = false;
    public $selectedLeaveType;
    public $form;
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification;

    protected $rules = [
        'libelle' => 'required',
        'description' => 'required',
    ];

    public function render()
    {
        $leaveTypes = LeaveTypeModel::all();
        return view('livewire.leave-type', compact('leaveTypes'));
    }
    public function resetAll()
    {
        $this->libelle = '';
        $this->description = '';

    }

    public function addLeaveType()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addLeaveType';
    }
    
    public function storeLeaveType()
    {
        $this->validate();

        LeaveTypeModel::create([
            'Libelle' => $this->libelle,
            'description' => $this->description,
        ]);

        $this->resetAll();
        $this->emit('success');
    }

    public function showEdit($leaveTypeId)
    {
        $leaveType = LeaveTypeModel::findOrFail($leaveTypeId);

        // Populate the form fields with leave type details
        $this->form = 'editLeaveType';
        $this->selectedLeaveType = $leaveType;
        $this->libelle = $leaveType->Libelle;
        $this->description = $leaveType->description;
        $this->editMode = true;
    }

    public function updateLeaveTypeConfirmed()
    {
        $this->validate();

        if ($this->selectedLeaveType) {
            // Update the selected leave type with the new values
            $this->selectedLeaveType->update([
                'Libelle' => $this->libelle,
                'description' => $this->description,
            ]);

            // Reset properties and exit edit mode after successful update
            $this->editMode = false;
            $this->reset(['libelle', 'description', 'selectedLeaveType']);

            // Show notification and flash message
            $this->notification = true;
            session()->flash('message', 'Leave type updated successfully!');
        }
    }

    public function deleteLeaveTypeConfirmation($leaveTypeId)
    {
        $this->selectedLeaveType = LeaveTypeModel::findOrFail($leaveTypeId);
    }

    public function deleteLeaveTypeConfirmed()
    {
        if ($this->selectedLeaveType) {
            $this->selectedLeaveType->delete();
            $this->selectedLeaveType = null;
            $this->notification = true;
            session()->flash('message', 'Leave type deleted successfully!');
        }
    }

    public function cancelEdit()
    {
        $this->editMode = false;
        $this->reset(['libelle', 'description', 'selectedLeaveType']);
    }
}
