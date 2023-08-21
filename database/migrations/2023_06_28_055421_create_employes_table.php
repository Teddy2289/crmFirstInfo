<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('address');
            $table->string('street_number');
            $table->foreignId('country_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('city');
            $table->string('postal_code');
            $table->string('birth_name');
            $table->date('date_of_birth');
            $table->string('birth_postal_code');
            $table->string('birth_city');
            $table->string('gender');
            $table->string('nationality');
            $table->string('social_security_number')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employes');
    }
}
