<?php

namespace App\Http\Controllers;

use App\Helpers\Date;
use App\Models\Contract;
use App\Models\Invoice as InvoiceModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class InvoiceAction extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InvoiceModel $invoice)
    {
        App::setLocale('fr');

        /** @var Contract $contract */
        $contract = $invoice->contract;
        $company = $contract->company;
        $client = $contract->client;
        $finalClient = $contract->finalclient;
     
        $seller = new Party([
            'name'          => $company->name,
            'vat' => $company->num_vat,
            'address'      => $company->address,
            'iban' => $company->iban,
            'bic' => $company->bic,
            'custom_address' =>  $company->postal_code . ', ' . $company->town,
            'custom_fields' => [
                'SIRET'        => $company->siret,
            ],
        ]);

        $customer = new Party([
            'name'          => $client->name,
            'vat' => $client->num_vat,
            'address'      => $client->address,
            'custom_address' => $client->postal_code . ', ' . $client->town,
            'custom_fields' => [
                'SIRET'        => $client->siret,
                'RCS' => $client->rcs,
            ],
        ]);

        $consultantName = $invoice->contract->user->name;
        $monthFr = Date::getMonthsFr()[$invoice->month];

        $items = [
            (new InvoiceItem())
                ->title(
                    'Prestations de services effectuées par ' . $consultantName . ' pour le mois de ' .
                     $monthFr . ' ' . $invoice->year
                )
                ->description('Nom du client : ' . $finalClient->name)
                ->pricePerUnit($contract->daily_rate)
                ->units('Jour')
                ->quantity($invoice->day_count)
                ->taxByPercent($invoice->contract->vat),
        ];

        foreach ($invoice->details as $detail) {
            $items[] = (new InvoiceItem())
                ->title($detail->label)
                ->pricePerUnit($detail->fee ? -$detail->price : $detail->price)
                ->units('')
                ->quantity($detail->quantity)
                ->taxByPercent($invoice->contract->vat)
            ;
        }

        $notes = [
            "",
            "Escompte pour paiement anticipé : néant.",
            "En conformité à l'article L.441-6 alinéa 12 du code de commerce, nous vous précisons que tout retard de paiement donnera lieu à l'application d'une indemnité forfaitaire de 40 euros pour frais de recouvrement. ",
            "En conformité à l'article L.441-6 alinéa 12 et D.441-5 ibidem du code de commerce, nous vous précisons que tout retard de paiement donnera lieu à l'application d'une pénalité au taux de trois fois le taux d'intérêt légal.",
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('Facture')
            ->serialNumberFormat($invoice->number)
            ->seller($seller)
            ->buyer($customer)
            ->taxableAmount($invoice->montant_ht)
            ->date(Carbon::createFromFormat('Y-m-d', $invoice->date))
            ->dateFormat('d/m/Y')
            ->payUntilDays($contract->payment_deadline)
            ->currencySymbol('€')
            ->currencyCode('Euro')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename('Facture -' . $client->name . ' - ' . $finalClient->name . ' - ' . $consultantName . ' - ' . $monthFr . ' ' . $invoice->year)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('assets/images/logo.png'))
            ->save('public');

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}