<?php

namespace App\Http\Livewire;

use App\Helpers\Date;
use App\Models\Contract;
use App\Models\Invoice as ModelsInvoice;
use App\Models\Payement;

use Livewire\Component;
use Livewire\WithPagination;

class Invoice extends Component
{
    use WithPagination;
    public $contract_id;
    public $payement_id;
    public $date;
    public $month;
    public $year;
    public $number;
    public $day_count;
    public $note;
    public $montant_ht;
    public $montant_ttc;
    public $date_sent;
    public $date_paid;
    public $details = [];
    public $form = '';
    public $confirmingDelete = false;
    public $confirmingUpdate = false;
    public $notification = false;
    public $loading = false;
    public $notificationMessage;

    protected $listeners = [
        'success' => 'showNotification',
        'clearNotification' => 'clearNotification',
    ];
    protected $rules = [
        'contract_id' => 'required|exists:companies,id',
        'payement_id' => 'required|exists:companies,id',
        'date' => 'required',
        'month' => 'required',
        'day_count' => 'required',
        'note' => 'nullable',
        'montant_ht' => 'required',
        'montant_ttc' => 'required',
        'date_sent' => 'required',
        'date_paid' => 'required',
        'details.*.label' => 'required',
        'details.*.quantity' => 'required|integer|min:1',
        'details.*.price' => 'required|numeric|min:0',
        'details.*.fee' => 'required|numeric|min:0',
    ];
    public function mount()
    {
        $this->generateUniqueNumber();
    }

    private function generateUniqueNumber()
    {
        do {
            $formattedNumber = str_pad($this->generateRandomNumber(), 4, '0', STR_PAD_LEFT);
        } while ($this->numberExists($formattedNumber));

        $this->number = $formattedNumber;
    }

    private function generateRandomNumber()
    {
        return mt_rand(1, 9999); // Générez un numéro aléatoire entre 1 et 9999
    }

    private function numberExists($number)
    {
        return ModelsInvoice::where('number', $number)->exists();
    }



    public function render()
    {
        $contracts = Contract::all();
        $payements = Payement::all();
        return view('livewire.invoice', [
            "contracts" => $contracts,
            "payements" => $payements,
            'monthsEn' => Date::getMonthsEn(),
        ]);
    }

    private function resetAll()
    {
        $this->contract_id = null;
        $this->payement_id = null;
        $this->date = null;
        $this->month = null;
        $this->year = null;
        $this->number = null;
        $this->day_count = null;
        $this->note = null;
        $this->montant_ht = null;
        $this->montant_ttc = null;
        $this->date_sent = null;
        $this->date_paid = null;
        $this->details = [];
        $this->form = '';
        $this->confirmingDelete = false;
        $this->confirmingUpdate = false;
    }

    public function addDetail()
    {
        $newDetail = [
            'label' => '',
            'quantity' => 1,
            // ... (autres champs)
        ];

        // Charger les données du modèle ici si nécessaire
        $this->details[] = $newDetail;
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details);
    }


    public function addInvoice()
    {
        $this->resetValidation();
        $this->reset();
        $this->form = 'addInvoice';
    }
    public function saveInvoice()
    {
        $validatedData = $this->validate([
            'contract_id' => 'required|exists:contracts,id',
            'payement_id' => 'required|exists:payements,id',
            'date' => 'required',
            'number'=> 'required',
            'month' => 'required',
            'day_count' => 'required',
            'note' => 'nullable',
            'montant_ht' => 'required',
            'montant_ttc' => 'required',
            'date_paid' => 'required',
            'date_sent' => 'required',
            'details.*.label' => 'required',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
            'details.*.fee' => 'required|numeric|min:0',
        ]);

        $invoice = ModelsInvoice::create([
            'contract_id' => $validatedData['contract_id'],
            'payement_id' => $validatedData['payement_id'],
            'date' => $validatedData['date'],
            'number'=> $validatedData['number'],
            'month' => $validatedData['month'],
            'day_count' => $validatedData['day_count'],
            'note' => $validatedData['note'],
            'montant_ht' => $validatedData['montant_ht'],
            'montant_ttc' => $validatedData['montant_ttc'],
            'date_paid' => $validatedData['date_paid'],
            'date_sent' => $validatedData['date_sent'],
        ]);

        foreach ($validatedData['details'] as $detailData) {
            $invoice->details()->create([
                'label' => $detailData['label'],
                'quantity' => $detailData['quantity'],
                'price' => $detailData['price'],
                'fee' => $detailData['fee'],
            ]);
        }
       
        // Rediriger ou afficher un message de succès
    }

    public function cancel()
    {
        $this->resetAll();
    }
}
