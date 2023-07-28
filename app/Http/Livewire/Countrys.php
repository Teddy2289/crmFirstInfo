<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Country;
use Livewire\WithPagination;

class Countrys extends Component
{

    use WithPagination;

    public $name, $code, $nationality;
    public $countryId;
    public $form ='';
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
        $countries = Country::paginate(20); // Paginer les résultats par 5 éléments par page
        return view('livewire.countrys', ['countries' => $countries]);
    }


}

