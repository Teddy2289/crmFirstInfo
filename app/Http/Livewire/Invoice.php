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
        $this->confirmingUpdate = true;
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
        $this->details = $this->details->toArray(); // Convert collection to array
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
            'number' => 'required',
            'month' => 'required',
            'day_count' => 'required',
            'note' => 'nullable',
            'montant_ht' => 'required',
            'year' => 'required',
            'date_paid' => 'required',
            'date_sent' => 'required',
            'details.*.label' => 'required',
            'details.*.quantity' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
            'details.*.fee' => 'required',
        ]);

        $invoice = ModelsInvoice::create([
            'contract_id' => $validatedData['contract_id'],
            'payement_id' => $validatedData['payement_id'],
            'date' => $validatedData['date'],
            'number' => $validatedData['number'],
            'month' => $validatedData['month'],
            'year' => $validatedData['year'],
            'day_count' => $validatedData['day_count'],
            'note' => $validatedData['note'],
            'montant_ht' => $validatedData['montant_ht'],
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

    public function showEdit($invoice_id)
    {
        $invoice = ModelsInvoice::findOrFail($invoice_id);
        if ($invoice) {
            $this->form = 'editInvoice';
            $this->confirmingUpdate = true;
            $this->invoice_id = $invoice_id;
            $this->contract_id = $invoice->contract_id;
            $this->payement_id = $invoice->payement_id;
            $this->date = $invoice->date;
            $this->month = $invoice->month;
            $this->year = $invoice->year;
            $this->number = $invoice->number;
            $this->day_count = $invoice->day_count;
            $this->note = $invoice->note;
            $this->montant_ht = $invoice->montant_ht;
            $this->date_paid = $invoice->date_paid;
            $this->date_sent = $invoice->date_sent;
            $this->details = $invoice->details->map(function ($detail) {
                return [
                    'label' => $detail->label,
                    'quantity' => $detail->quantity,
                    'price' => $detail->price,
                    'fee' => $detail->fee,
                ];
            });
            
        };
    }
    
    public function updateInvoiceConfirmed()
    {
        $this->loading = true;
        if ($this->confirmingUpdate) {
            $invoice = ModelsInvoice::find($this->invoice_id);
            if ($invoice) {
                $invoice->update([
                    'date' => $this->date,
                    'number' => $this->number,
                    'month' => $this->month,
                    'year' => $this->year,
                    'day_count' => $this->day_count,
                    'note' => $this->note,
                    'montant_ht' => $this->montant_ht,
                    'date_paid' => $this->date_paid,
                    'date_sent' => $this->date_sent,
                ]);
                foreach ($this->details as $index => $detail) {
                    $detailModel = $invoice->details[$index];
                    $detailModel->update([
                        'label' => $detail['label'],
                        'quantity' => $detail['quantity'],
                        'price' => $detail['price'],
                        'fee' => $detail['fee'],
                    ]);
                }                
                $this->resetAll();
                $this->notificationMessage = 'Facture mis à jour avec succes.';
                $this->emit('success');
                $this->confirmingUpdate = false;
                $this->loading = false;
            }
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
