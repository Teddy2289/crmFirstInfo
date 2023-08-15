<?php

namespace App\Observers;

use App\Models\Invoice;

class InvoiceObserver
{
    public function saving(Invoice $invoice)
    {
        $contract = $invoice->contract()->first();
        $invoice->montant_ht = (float) $contract->daily_rate * (float) $invoice->day_count;
        $invoice->montant_ttc = $invoice->montant_ht + $invoice->montant_ht * 20/100;
        $totalPrixDetails = $invoice->details->sum('price');
        $invoice->montant_ht -= $totalPrixDetails;
        $invoice->montant_ttc = $invoice->montant_ht + $invoice->montant_ht * 20/100;
    }
}
