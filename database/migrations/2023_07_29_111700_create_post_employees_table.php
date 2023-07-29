<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->enum('type_contrat',['CDI','CDD','intern'])->default('CDI');
            $table->date('start_date');
            $table->foreignId('user_id')->constrained();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('post_employees');
    }
}
