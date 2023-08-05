<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payement as ModelsPayement;

class Payement extends Component
{

    use WithPagination;

    public $label;
    public $payementId;
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

    public function showNotification()
    {
        $this->notification = true;
    }

    public function clearNotification()
    {
        $this->notification = false;
        $this->notificationMessage = '';
    }
    public function render()
    {
        $payements = ModelsPayement::paginate(10);
        return view('livewire.payement', 
            ['payements' => $payements]);
    }

    public function resetAll()
    {
        $this->label = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addPayement()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addPayement';
    }

    public function storePayement()
    {
        $this->validate([
            'label' => 'required',
        ]);
        
        ModelsPayement::create([
            'label' => $this->label,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Payement ajouté avc succes.';
        $this->emit('success');
    }

    public function showEdit($payement_Id)
    {
        $payement = ModelsPayement::find($payement_Id);
        if ($payement) {
            $this->form = 'editPayement';
            $this->confirmingUpdate = true;
            $this->payementId = $payement_Id;
            $this->label = $payement->label;
        }
    }

    public function updatePayementConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $payement = ModelsPayement::find($this->payementId);
            if ($payement) {
                $payement->update([
                    'label' => $this->label,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Payement mis à jour avec succes';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deletePayementConfirmed()
    {
        $payement = ModelsPayement::find($this->payementId);
        if ($payement) {
            $payement->delete();
            $this->resetAll();
            $this->notificationMessage = 'Payement supprimé avec succes';
            $this->emit('success');
        }
    }

    public function deletePayementConfirmation($payement_Id)
    {
        $this->payementId = $payement_Id;
        $this->confirmingDelete = true;
    }

    public function deletePayement()
    {
        $payement = ModelsPayement::find($this->payementId);
        if ($payement) {
            $payement->delete();
            $this->resetAll();
            $this->emit('success');
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }
}
