<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LeaveRequested as ModelsLeaveRequest;
use App\Models\Company;
use App\Models\Employe;
use App\Models\LeaveType;
use App\Models\WithPagination;
use Livewire\WithPagination as LivewireWithPagination;

class LeaveRequest extends Component
{

    use LivewireWithPagination;

    public $employe_id, $leave_type_id, $company_id, $Leave_reason, $start_date, $end_date, $statut; 
    public $leaveRequest_id;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;
    public $notificationMessage;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => 'showNotification',
        'clearNotification' => 'clearNotification',
    ];

    protected $rules = [
        'employe_id' => 'required|exists:employes,id',
        'leave_type_id' => 'required|exists:leave_types,id',
        'company_id' => 'required|exists:companies,id',
        'Leave_reason' => 'required',
        'start_date' => 'required|date|',
        'end_date' => 'required|date|after:start_date',
        'statut' => 'required'
        
    ];

    protected $messages = [
        'employe_id.required' => 'Le champ Employé est obligatoire.',
        'employe_id.exists' => 'L\'employé sélectionné n\'existe pas.',
        'leave_type_id.required' => 'Le champ Type de congé est obligatoire.',
        'leave_type_id.exists' => 'Le type de congé sélectionné n\'existe pas.',
        'company_id.required' => 'Le champ Entreprise est obligatoire.',
        'company_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
        'Leave_reason.required' => 'Le champ Raison du congé est obligatoire.',
        'start_date.required' => 'Le champ Date de début est obligatoire.',
        'start_date.date' => 'Le champ Date de début doit être une date valide.',
        'end_date.required' => 'Le champ Date de fin est obligatoire.',
        'end_date.date' => 'Le champ Date de fin doit être une date valide.',
        'end_date.after' => 'La date de fin doit être après la date de début.',
        'statut.required' => 'Le champ Statut est obligatoire.'
        
    ];


    public function render()
        {
            $leaveRequesteds = ModelsLeaveRequest::with('company', 'leaveType', 'employe')->paginate(5);
            $leaveTypes = LeaveType::all();
            $employees = Employe::all();
            $companies = Company::all();

            return view('livewire.leave-request', [
                'leaveRequesteds' => $leaveRequesteds,
                'leaveTypes' => $leaveTypes,
                'employees' => $employees,
                'companies' => $companies,
                ]);
        }


    public function resetAll()
    {
        $this->employe_id = '';
        $this->leave_type_id = '';
        $this->company_id = '';
        $this->Leave_reason = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->statut = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;

    }
    public function showNotification()
    {
        $this->notification = true;
    }

    public function clearNotification()
    {
        $this->notification = false;
        $this->notificationMessage = '';
    }

    public function addLeaveRequest()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addLeaveRequest';
    }
    public function storeLeaveRequest()
    {
        $this->loading = true;
        $this->validate();

        ModelsLeaveRequest::create([
            'employe_id' => $this->employe_id,
            'leave_type_id' => $this->leave_type_id,
            'company_id' => $this->company_id,
            'Leave_reason' => $this->Leave_reason,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'statut' => $this->statut,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Demande ajouté(e) avec succes.';
        $this->emit('success');
        $this->loading = false;
    }    

    public function showEdit($LeaveRequst_Id)
    {
        $leaveRequest = ModelsLeaveRequest::find($leaveRequest_id);
        if ($leaveRequest) {
            $this->form = 'editLeaveRequest';
            $this->confirmingUpdate = true;
            $this->leaveRequest_id = $leaveRequest_id;
            $this->employe_id = $leaveRequest->employe_id;
            $this->leave_type_id = $leaveRequest->leave_type_id;
            $this->company_id = $leaveRequest->company_id;
            $this->Leave_reason = $leaveRequest->Leave_reason;
            $this->start_date = $leaveRequest->start_date;
            $this->end_date = $leaveRequest->end_date;
            $this->statut = $leaveRequest->statut;

        }
    }

    public function updateLeaveRequestConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $leaveRequest = ModelsLeaveRequest::find($this->leaveRequest_id);
            if ($leaveRequest) {
                $leaveRequest->update([
                    'employe_id' => $this->employe_id,
                    'leave_type_id' => $this->leave_type_id,
                    'company_id' => $this->company_id,
                    'Leave_reason' => $this->Leave_reason,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'statut' => $this->statut,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Demande mis à jour avec succes.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }
    
    public function deleteLeaveRequestConfirmation($leaveRequest_id)
    {
        $this->leaveRequest_id = $leaveRequest_id;
        $this->confirmingDelete = true;
    }

    public function deleteLeaveRequestConfirmed()
    {
        $this->loading = true;
        $leaveRequest = ModelsLeaveRequest::find($this->leaveRequest_id);

        if ($leaveRequest) {
            $leaveRequest->delete();
            $this->resetAll();
            $this->notificationMessage = 'Demande supprimé avec succes';
            $this->emit('success');
            $this->dispatchBrowserEvent('close-delete-confirmation-modal');
            $this->loading = false;
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }

}

