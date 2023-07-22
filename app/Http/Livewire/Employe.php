<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Country;
use App\Models\Employe as ModelsEmploye;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Employe extends Component
{
    use WithPagination;

    public $phone_number,
        $address,
        $street_number,
        $company_id,
        $country_id,
        $user_id,
        $city,
        $postal_code,
        $birth_name,
        $date_of_birth,
        $birth_postal_code,
        $birth_city,
        $gender,
        $nationality,
        $social_security_number;
    public $employe_id;
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;

    protected $rules = [
        'phone_number' => 'required',
        'address' => 'required',
        'street_number' => 'required',
        'company_id' => 'required|exists:companies,id',
        'country_id' => 'required|exists:countries,id',
        'user_id' => 'required|exists:users,id',
        'city' => 'required',
        'postal_code' => 'required',
        'birth_name' => 'required',
        'date_of_birth' => 'required',
        'birth_postal_code' => 'required',
        'birth_city' => 'required',
        'gender' => 'required',
        'nationality' => 'required',
        'social_security_number' => 'required',
    ];

    public function render()
    {
        $employees = ModelsEmploye::with('country')->paginate(5);
        $countries = Country::all();
        $companies = Company::all();
        $users  = User::all();

        return view('livewire.employe', compact('employees', 'countries', 'companies', 'users'));
    }

    public function resetAll()
    {
        $this->phone_number = '';
        $this->address = '';
        $this->street_number = '';
        $this->country_id = '';
        $this->company_id = '';
        $this->user_id = '';
        $this->city = '';
        $this->postal_code = '';
        $this->birth_name = '';
        $this->date_of_birth = '';
        $this->birth_postal_code = '';
        $this->birth_city = '';
        $this->gender = '';
        $this->nationality = '';
        $this->social_security_number = '';
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addEmployee()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addEmployee';
    }

    public function storeEmployee()
    {
        $this->validate();

        ModelsEmploye::create([
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'street_number' => $this->street_number,
            'company_id' => $this->company_id,
            'country_id' => $this->country_id,
            'user_id' => $this->user_id,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'birth_name' => $this->birth_name,
            'date_of_birth' => $this->date_of_birth,
            'birth_postal_code' => $this->birth_postal_code,
            'birth_city' => $this->birth_city,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'social_security_number' => $this->social_security_number,
        ]);

        $this->resetAll();
        $this->emit('success');
    }

    public function showEdit($employe_id)
    {
        $employe = ModelsEmploye::find($employe_id);
        if ($employe) {
            $this->form = 'editEmploye';
            $this->confirmingUpdate = true;
            $this->employe_id = $employe_id;
            $this->phone_number = $employe->phone_number;
            $this->address = $employe->address;
            $this->street_number = $employe->street_number;
            $this->country_id = $employe->country_id;
            $this->company_id = $employe->company_id;
            $this->user_id = $employe->user_id;
            $this->city = $employe->city;
            $this->postal_code = $employe->postal_code;
            $this->birth_name = $employe->birth_name;
            $this->date_of_birth = $employe->date_of_birth;
            $this->birth_postal_code = $employe->birth_postal_code;
            $this->birth_city = $employe->birth_city;
            $this->gender = $employe->gender;
            $this->nationality = $employe->nationality;
            $this->social_security_number = $employe->social_security_number;
        }
    }

    public function updateEmployeConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $employe = ModelsEmploye::find($this->employe_id);
            if ($employe) {
                $employe->update([
                    'phone_number' => $this->phone_number,
                    'address' => $this->address,
                    'street_number' => $this->street_number,
                    'country_id' => $this->country_id,
                    'company_id' => $this->company_id,
                    'user_id' => $this->user_id,
                    'city' => $this->city,
                    'postal_code' => $this->postal_code,
                    'birth_name' => $this->birth_name,
                    'date_of_birth' => $this->date_of_birth,
                    'birth_postal_code' => $this->birth_postal_code,
                    'birth_city' => $this->birth_city,
                    'gender' => $this->gender,
                    'nationality' => $this->nationality,
                    'social_security_number' => $this->social_security_number,
                ]);
                $this->resetAll();
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
        }
    }

    public function deleteEmployeeConfirmation($employe_id)
    {
        $this->employe_id = $employe_id;
        $this->confirmingDelete = true;
    }

    public function deleteEmployee()
    {
        $employee = ModelsEmploye::find($this->employe_id);

        if ($employee) {
            $employee->delete();
            $this->resetAll();
            $this->emit('success');
        }
    }

    public function cancel()
    {
        $this->resetAll();
    }


}
