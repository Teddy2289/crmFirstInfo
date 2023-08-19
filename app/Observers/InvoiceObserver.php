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

        if (!$invoice->details->isEmpty()){
            foreach ($invoice->details as $detail) {
                if ($detail->fee == 1) {
                    $invoice->montant_ht -= $detail->price;
                } else {
                    $invoice->montant_ht += $detail->price;
                }
            }
        }

        $invoice->montant_ttc = $invoice->montant_ht + $invoice->montant_ht * 20/100;
    }
}
