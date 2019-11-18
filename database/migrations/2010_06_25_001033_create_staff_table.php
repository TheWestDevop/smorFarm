<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('img');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('address');
            $table->string('state');
            $table->string('country');
            $table->string('salary');
            $table->string('married_status');
            $table->string('job_title');
            $table->string('next_of_kin');
            $table->string('next_of_kin_address');
            $table->string('next_of_kin_phone');
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
        Schema::dropIfExists('staff');
    }
}
