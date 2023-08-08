<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('clients')->insert([
                'name' => 'Client 1',
                'phone' => '123-456-7890',
                'address' => 'Address 1',
                'country_id' => 1, // Replace 1 with the appropriate country_id for the client
                'created_at' => now()->subDays(rand(0, 365))->subMonths(rand(0, 12)),
                'updated_at' => now(),
            ]);
        }
    }
}
