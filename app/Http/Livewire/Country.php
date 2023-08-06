<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Country as ModelsCountry;


class Country extends Component
{
    use WithPagination;

    public $name, $code, $nationality;
    public $countryId;
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

    public function render()
    {
        $countries = ModelsCountry::paginate(10);
        return view('livewire.country', 
            ['countries' => $countries]);
    }


    public function resetAll()
    {
        $this->name = '';
        $this->code = '';
        $this->nationality = '';
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

    public function addCountry()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addCountry';
    }

    public function storeCountry()
    {
        $this->validate([
            'name' => 'required',
            'code' => 'required',
            'nationality' => 'required',
        ]);

        ModelsCountry::create([
            'name' => $this->name,
            'code' => $this->code,
            'nationality' => $this->nationality,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Pays ajouté avec succes.';
        $this->emit('success');
    }

    public function showEdit($country_id)
    {
        $country = ModelsCountry::find($country_id);
        if ($country) {
            $this->form = 'editCountry';
            $this->confirmingUpdate = true;
            $this->countryId = $country_id;
            $this->name = $country->name;
            $this->code = $country->code;
            $this->nationality = $country->nationality;
        }
    }

    public function updateCountryConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $country = ModelsCountry::find($this->countryId);
            if ($country) {
                $country->update([
                    'name' => $this->name,
                    'code' => $this->code,
                    'nationality' => $this->nationality,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Pays mis à jour avec succes.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deleteCountryConfirmed()
    {
        $country = ModelsCountry::find($this->countryId);
        if ($country) {
            $country->delete();
            $this->resetAll();
            $this->notificationMessage = 'Pays supprimé avec succes.';
            $this->emit('success');
        }
    }

    public function deleteCountryConfirmation($country_id)
    {
        $this->countryId = $country_id;
        $this->confirmingDelete = true;
    }

    public function deleteCountry()
    {
        $country = ModelsCountry::find($this->countryId);
        if ($country) {
            $country->delete();
            $this->resetAll();
            $this->emit('success');
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }
}
