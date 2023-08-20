<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Client;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contract as ModelsContract;


class Contract extends Component
{
    use WithPagination;

    public $label, $client_id,$final_client_id, $user_id, $daily_rate, $start_date, $end_date,$company_id;
    public $contract_id;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $notificationMessage;

    public $loading = false;
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
        $contracts = ModelsContract::with('client', 'user','company')->paginate(5);
        $clients = Client::all();
        $users = User::all();
        $companies = Company::all();

        return view('livewire.contract', [
                'contracts' => $contracts,
                'clients' => $clients,
                'users' => $users,
                'companies' => $companies,
            ]
        );
    }

    public function addContract()
    {
        $this->form = 'addContract';
    }

    public function resetAll()
    {
        $this->label = '';
        $this->client_id = '';
        $this->user_id = '';
        $this->company_id = '';
        $this->final_client_id = '';
        $this->daily_rate = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function storeContract()
    {
        $this->loading = true;
        $this->validate([
            'label' => 'required',
            'client_id' => 'required|exists:clients,id',
            'final_client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'daily_rate' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        ModelsContract::create([
            'label' => $this->label,
            'client_id' => $this->client_id,
            'final_client_id' => $this->client_id,
            'company_id' => $this->company_id,
            'user_id' => $this->user_id,
            'daily_rate' => $this->daily_rate,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Contrat ajouté avec succes';
        $this->emit('success');
        $this->loading = false;
    }

    public function showEdit($contract_id)
    {
        $contract = ModelsContract::find($contract_id);
        if ($contract) {
            $this->form = 'editContract';
            $this->confirmingUpdate = true;
            $this->contract_id = $contract_id;
            $this->label = $contract->label;
            $this->client_id = $contract->client_id;
            $this->final_client_id = $contract->final_client_id;
            $this->company_id = $contract->company_id;
            $this->user_id = $contract->user_id;
            $this->daily_rate = $contract->daily_rate;
            $this->start_date = $contract->start_date;
            $this->end_date = $contract->end_date;
        }
    }

    public function updateContractConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $contract = ModelsContract::find($this->contract_id);
            if ($contract) {
                $contract->update([
                    'label' => $this->label,
                    'client_id' => $this->client_id,
                    'final_client_id' => $this->client_id,
                    'user_id' => $this->user_id,
                    'company_id' => $this->company_id,
                    'daily_rate' => $this->daily_rate,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Contrat mis à jour avec succes.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deleteContractConfirmation($contract_id)
    {
        $this->contract_id = $contract_id;
        $this->confirmingDelete = true;
    }

    public function deleteContractConfirmed()
    {
        $this->loading = true;
        $contract = ModelsContract::find($this->contract_id);
        if ($contract) {
            $contract->delete();
            $this->resetAll();
            $this->notificationMessage = 'Contrat supprimé avec succes';
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
