<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContractClientFinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreignId('final_client_id')->after('client_id')->nullable()->constrained('clients', 'id');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->boolean('esn')->after('name')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('final_client_id');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('esn');
        });
    }
}
