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
    public $invoice_id;
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
    public $editingInvoiceId = null;
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

    public function generateUniqueNumber()
    {
        $year = date('Y');
        $lastNumber = ModelsInvoice::where('number', 'like', "{$year}%")
            ->orderBy('number', 'desc')
            ->value('number');

        $lastSerial = intval(substr($lastNumber, 5)) + 1;
        $this->number = "$year-" . str_pad($lastSerial, 4, '0', STR_PAD_LEFT);
    }
    


    public function render()
    {
        $this->generateUniqueNumber();
        $invoices = ModelsInvoice::paginate(8); 
        $contracts = Contract::all();
        $payements = Payement::all();
        return view('livewire.invoice', [
            'invoices' => $invoices,
            "contracts" => $contracts,
            "payements" => $payements,
            'monthsEn' => Date::getMonthsEn(),
            'number' => $this->number,
        ]);
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

    public function setDefaultFeeValue()
    {
        foreach ($this->details as &$detail) {
            $detail['fee'] = $detail['fee'] ?? 0;
        }
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
            'quantity' => '',
            'fee' => 0
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
            'year' => 'required',
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
            'year' => $validatedData['year'],
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
       
        $this->resetAll();
        $this->notificationMessage = 'Facture(s) ajouté(e) avec succes.';
        $this->emit('success');
    }

    public function showEdit($invoiceId)
{
    $this->resetAll(); 
    $this->form = 'editInvoice';
    $this->editingInvoiceId = $invoiceId;
    $this->loading = true;

    $invoice = ModelsInvoice::findOrFail($invoiceId);

    $this->contract_id = $invoice->contract_id;
    $this->payement_id = $invoice->payement_id;
    $this->details = $invoice->details->map(function ($detail) {
        return [
            'label' => $detail->label,
            'quantity' => $detail->quantity,
            'price' => $detail->price,
            'fee' => $detail->fee,
        ];
    });

    $this->loading = false;
}
   public function updateInvoice()
    {
        $this->validate([
            'date' => 'required|date',
            'month' => 'required',
            'year' => 'required',
            // ... add validation rules for other properties ...
        ]);

        $invoice = Invoice::findOrFail($this->editingInvoiceId);
        $invoice->update([
            'date' => $this->date,
            'month' => $this->month,
            'year' => $this->year,
            // ... update other properties ...
        ]);
        $this->resetForm();
        $this->emit('success', __('Invoice updated successfully.'));
    }

    public function resetForm()
    {
        $this->date = null;
        $this->month = null;
        $this->year = null;
        // ... reset other properties ...
    }
    public function updateInvoiceConfirmed()
    {
  
    $this->validate([
        'date' => 'required|date',
        'month' => 'required',
        'year' => 'required',
        'contract_id' => 'required|exists:contracts,id',
        'payement_id' => 'required|exists:payements,id', 
        'day_count' => 'required|integer|min:1',
        'note' => 'nullable', 
        'montant_ht' => 'required|numeric|min:0',
        'montant_ttc' => 'required|numeric|min:0', 
        'date_sent' => 'required|date', 
        'date_paid' => 'required|date', 
        // ... Add validation rules for other fields ...
    ]);

    // Find the invoice by its ID
    $invoice = ModelsInvoice::find($this->editingInvoiceId);

    // Update the invoice's data with the edited values
    if ($invoice) {
        // Update the invoice's data with the edited values
        $invoice->date = $this->date;
        $invoice->month = $this->month;
        $invoice->year = $this->year;
        $invoice->contract_id = $this->contract_id;
        $invoice->payement_id = $this->payement_id;
        $invoice->day_count = $this->day_count;
        $invoice->note = $this->note;
        $invoice->montant_ht = $this->montant_ht;
        $invoice->montant_ttc = $this->montant_ttc;
        $invoice->date_sent = $this->date_sent;
        $invoice->date_paid = $this->date_paid;
        // ... Update other fields ...

        $invoice->update();
        $this->resetForm();
        $this->editingInvoiceId = null; 
        $this->notificationMessage = 'Facture modifiee avec succes.';
        $this->emit('success');
        $this->form = '';
    }
    }


        public function deleteInvoiceConfirmation($invoiceId)
    {
       $this->confirmingDelete = true;
       $this->invoice_id = $invoiceId;
    }
        public function deleteInvoiceConfirmed()
{
        $invoice = ModelsInvoice::find($this->invoice_id);

    if ($invoice) {
        $invoice->details()->delete();
        $invoice->delete();
        $this->notificationMessage = 'Facture supprimé(e) avec succes.';
        $this->resetAll();
        $this->emit('success');
    }
 }

    public function cancel()
    {
        $this->resetAll();
    }
  }
