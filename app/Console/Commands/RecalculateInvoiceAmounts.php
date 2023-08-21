<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class RecalculateInvoiceAmounts extends Command
{
    protected $signature = 'app:invoice:recalculate';

    protected $description = 'Recalculate the HT/TTC amounts for all invoices';

    public function handle()
    {
        $invoices = Invoice::all();
        foreach ($invoices as $invoice) {
            $this->recalculateInvoiceAmounts($invoice);
        }
        $this->info('All invoice amounts recalculated successfully.');
    }

    private function recalculateInvoiceAmounts(Invoice $invoice)
    {
        $contract = $invoice->contract()->first();
        $invoice->montant_ht = (float) $contract->daily_rate * (float) $invoice->day_count;
        foreach ($invoice->details as $detail) {
            if ($detail->fee == 1) {
                $invoice->montant_ht -= $detail->price;
            } else {
                $invoice->montant_ht += $detail->price;
            }
        }
        $invoice->montant_ttc = $invoice->montant_ht + $invoice->montant_ht * 20/100;
        $invoice->save();
    }
}
