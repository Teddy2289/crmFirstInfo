<?php

namespace App\Http\Livewire;

use App\Models\Company as ModelsCompany;
use Livewire\WithPagination;
use Livewire\Component;

class Company extends Component
{
    use WithPagination;

    public $name, $trade_name, $email, $phone, $address, $postal_code, $town, $capital, $siren, $siret, $ape, $rcs, $num_vat, $iban, $bic;
    public $companyId;
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
        $companies = ModelsCompany::paginate(5);

        return view('livewire.company', [
            'companies' => $companies,
        ]);
    }
    public function resetAll()
    {
        $this->name = '';
        $this->trade_name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->postal_code = '';
        $this->town = '';
        $this->capital = '';
        $this->siren = '';
        $this->siret = '';
        $this->ape = '';
        $this->rcs = '';
        $this->num_vat = '';
        $this->iban = '';
        $this->bic = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addCompany()
    {
        $this->form = 'addCompany';
    }

    public function storeCompany()
    {
        $this->loading = true;
        $this->validate([
            'name' => 'required',
            'trade_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|digits:13',
            'address' => 'required',
            'postal_code' => 'required',
            'town' => 'required',
            'capital' => 'required|numeric',
            'siren' => 'nullable|unique:companies',
            'siret' => 'nullable|unique:companies',
            'ape' => 'nullable',
            'rcs' => 'nullable',
            'num_vat' => 'nullable',
            'iban' => 'nullable',
            'bic' => 'nullable',
        ]);

        ModelsCompany::create([
            'name' => $this->name,
            'trade_name' => $this->trade_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'town' => $this->town,
            'capital' => $this->capital,
            'siren' => $this->siren,
            'siret' => $this->siret,
            'ape' => $this->ape,
            'rcs' => $this->rcs,
            'num_vat' => $this->num_vat,
            'iban' => $this->iban,
            'bic' => $this->bic,
        ]);

        $this->resetAll();
        $this->notificationMessage = 'Company added successfully.';
        $this->emit('success');
        $this->loading = false;
    }


    public function showEdit($companyId)
    {
        $company = ModelsCompany::find($companyId);
        if ($company) {
            $this->form = 'editCompany';
            $this->confirmingUpdate = true;
            $this->companyId = $companyId;
            $this->name = $company->name;
            $this->trade_name = $company->trade_name;
            $this->email = $company->email;
            $this->phone = $company->phone;
            $this->address = $company->address;
            $this->postal_code = $company->postal_code;
            $this->town = $company->town;
            $this->capital = $company->capital;
            $this->siren = $company->siren;
            $this->siret = $company->siret;
            $this->ape = $company->ape;
            $this->rcs = $company->rcs;
            $this->num_vat = $company->num_vat;
            $this->iban = $company->iban;
            $this->bic = $company->bic;
        }
    }

    public function updateCompanyConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $company = ModelsCompany::find($this->companyId);
            if ($company) {
                $company->update([
                    'name' => $this->name,
                    'trade_name' => $this->trade_name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'postal_code' => $this->postal_code,
                    'town' => $this->town,
                    'capital' => $this->capital,
                    'siren' => $this->siren,
                    'siret' => $this->siret,
                    'ape' => $this->ape,
                    'rcs' => $this->rcs,
                    'num_vat' => $this->num_vat,
                    'iban' => $this->iban,
                    'bic' => $this->bic,
                ]);
                $this->resetAll();
                $this->notificationMessage = 'Company updated successfully.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deleteCompanyConfirmation($companyId)
    {
        $this->companyId = $companyId;
        $this->confirmingDelete = true;
    }

    public function deleteCompanyConfirmed()
    {
        $this->loading = true;
        $company = ModelsCompany::find($this->companyId);
        if ($company) {
            $company->delete();
            $this->resetAll();
            $this->notificationMessage = 'Company deleted successfully.';
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
