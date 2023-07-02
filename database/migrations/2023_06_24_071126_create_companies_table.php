<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('trade_name');
            $table->string('email');
            $table->string('phone', 13)->nullable();
            $table->string('address');
            $table->string('postal_code');  
            $table->string('town');  
            $table->decimal('capital',8, 2);  
            $table->string('siren', 20)->unique()->nullable();
            $table->string('siret', 20)->unique()->nullable();
            $table->string('ape', 10)->nullable();
            $table->string('rcs', 50)->nullable();
            $table->string('num_vat', 50)->nullable();
            $table->string('iban', 50)->nullable();
            $table->string('bic', 50)->nullable();

            $table->timestamps();
        });
        Schema::table('contracts', fn(Blueprint $table) => $table->foreignId('company_id')->after('id')->constrained());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', fn(Blueprint $table) => $table->dropConstrainedForeignId('company_id'));
        Schema::dropIfExists('companies');
    }
}
