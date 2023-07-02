<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert(
            [
                'name' => 'FirstInfo',
                'trade_name' => 'FirstInfo Lab',
                'email' => 'firstinfolab@gmail.com',
                'phone' => '0665513547',
                'address' => '5 Parvis de la Bièvre',
                'postal_code' => '92160',
                'town' => 'Antony',
                'siren' => '900000308',
                'siret' => '90000030800016',
                'ape' => '6202A',
                'rcs' => 'Nanterre B 900 000 308',
                'num_vat' => 'FR19900000308',
                'capital' => 1000,
                'iban' => 'FR76 1820 6002 4165 0801 5470 928',
                'bic' => 'AGRIFRPP882',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
