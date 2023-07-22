<?php

namespace App\Http\Livewire;

use App\Models\Client as ModelsClient;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class Client extends Component
{
    use WithPagination;

    public $name, $phone, $address, $postal_code, $country_id, $tva;
    public $clientId;
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
        $clients = ModelsClient::with('country')->paginate(5);
        $countries = Country::all();

        return view('livewire.client', [
            'clients' => $clients,
            'countries' => $countries,
        ]);
    }

    public function resetAll()
    {
        $this->name = '';
        $this->phone = '';
        $this->address = '';
        $this->postal_code = '';
        $this->country_id = '';
        $this->tva = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addClient()
    {
        $this->form = 'addClient';
    }

    public function storeClient()
    {
        $this->loading = true;
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'country_id' => 'required|exists:countries,id',
            'tva' => 'required',
        ]);

        ModelsClient::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'country_id' => $this->country_id,
            'tva' => $this->tva,
        ]);

        $this->resetAll();
        $this->emit('success');
        $this->loading = false;
    }

    public function showEdit($clientId)
    {
        $client = ModelsClient::find($clientId);
        if ($client) {
            $this->form = 'editClient';
            $this->confirmingUpdate = true;
            $this->clientId = $clientId;
            $this->name = $client->name;
            $this->phone = $client->phone;
            $this->address = $client->address;
            $this->postal_code = $client->postal_code;
            $this->country_id = $client->country_id;
            $this->tva = $client->tva;
        }
    }

    public function updateClientConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $client = ModelsClient::find($this->clientId);
            if ($client) {
                $client->update([
                    'name' => $this->name,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'postal_code' => $this->postal_code,
                    'country_id' => $this->country_id,
                    'tva' => $this->tva,
                ]);
                $this->resetAll();
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deleteClientConfirmation($clientId)
    {
        $this->clientId = $clientId;
        $this->confirmingDelete = true;
    }

    public function deleteClientConfirmed()
    {
        $this->loading = true;
        $client = ModelsClient::find($this->clientId);
        if ($client) {
            $client->delete();
            $this->resetAll();
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
