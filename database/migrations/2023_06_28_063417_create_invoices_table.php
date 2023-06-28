<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained();
            $table->foreignId('payement_id')->constrained();
            $table->date('date');
            $table->string('month')->nullable();
            $table->integer('year')->nullable();
            $table->string('number', 50);
            $table->float('day_count');
            $table->text('note')->nullable();
            $table->float('montant_ht')->nullable();
            $table->float('montant_ttc')->nullable();
            $table->date('date_sent')->nullable();
            $table->date('date_paid')->nullable();
            $table->timestamps();
        });

        Schema::table('contracts', function (Blueprint $table) {
            $table->float('vat')->nullable()->default(20)->after('end_date');
            $table->integer('payment_deadline')->nullable()->default(30)->after('vat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');

        Schema::table('contracts', function(Blueprint $table) {
            $table->dropColumn('vat');
            $table->dropColumn('payment_deadline');
        });
    }
}
