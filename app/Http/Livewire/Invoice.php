<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use App\Models\Payement;
use Livewire\Component;
use Livewire\WithPagination;

class Invoice extends Component
{
    use WithPagination;
    public $contract_id;
    public $payment_id;
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
        'payment_id' => 'required|exists:companies,id',
        'date' => 'required',
        'month' => 'required',
        'day_count' => 'required',
        'note' => 'nullable',
        'montant_ht' => 'required',
        'montant_ttc' => 'required',
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
        $contracts = Contract::all();
        $payements = Payement::all();
        return view('livewire.invoice', [
            "contracts" => $contracts,
            "payements" => $payements
        ]);
    }

    private function resetFields()
        {
            $this->contract_id = null;
            $this->payment_id = null;
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

    public function saveInvoice()
    {
        $validatedData = $this->validate([
            'contract_id' => 'required|exists:contracts,id',
            'payment_id' => 'required|exists:payements,id',
            'date' => 'required',
            'month' => 'required',
            'day_count' => 'required',
            'note' => 'nullable',
            'montant_ht' => 'required',
            'montant_ttc' => 'required',
            'birth_name' => 'required',
            'date_of_birth' => 'required',
            'birth_postal_code' => 'required',
            'birth_city' => 'required',
            'gender' => 'required',
            'nationality' => 'required',
            'social_security_number' => 'required',
            'details.*.label' => 'required',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
            'details.*.fee' => 'required|numeric|min:0',
        ]);

        $invoice = Invoice::create([
            'contract_id' => $validatedData['contract_id'],
            'payment_id' => $validatedData['payment_id'],
            'date' => $validatedData['date'],
            'month' => $validatedData['month'],
            'day_count' => $validatedData['day_count'],
            'note' => $validatedData['note'],
            'montant_ht' => $validatedData['montant_ht'],
            'montant_ttc' => $validatedData['montant_ttc'],
            'birth_name' => $validatedData['birth_name'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'birth_postal_code' => $validatedData['birth_postal_code'],
            'birth_city' => $validatedData['birth_city'],
            'gender' => $validatedData['gender'],
            'nationality' => $validatedData['nationality'],
            'social_security_number' => $validatedData['social_security_number'],
        ]);

        foreach ($validatedData['details'] as $detailData) {
            $invoice->details()->create([
                'label' => $detailData['label'],
                'quantity' => $detailData['quantity'],
                'price' => $detailData['price'],
                'fee' => $detailData['fee'],
            ]);
        }
        dd("Test ok");
        // Rediriger ou afficher un message de succès
    }

}
